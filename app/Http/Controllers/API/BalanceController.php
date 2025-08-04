<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Models\AccountTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AccountTransactionResource;

class BalanceController extends Controller
{
    // define middleware
    public function __construct()
    {
        $this->middleware('can:account-balance-list', ['only' => ['index', 'search']]);
        $this->middleware('can:account-balance-create', ['only' => ['create']]);
        $this->middleware('can:account-balance-edit', ['only' => ['update']]);
        $this->middleware('can:account-balance-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return AccountTransactionResource::collection(AccountTransaction::with('cashbookAccount', 'user')->where('reason', 'LIKE', 'Non invoice balance added%')->orWhere('reason', 'LIKE', 'Non invoice balance removed from%')->latest()->paginate($request->perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'account' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'nullable|date_format:Y-m-d',
            'note' => 'nullable|string|max:255',
        ]);
        try {

            // generate reason
            $accountNumber = $request->account['accountNumber'];
            if ($request->type == 1) {
                $reason = "Non invoice balance added to [$accountNumber]";
            } else {
                $reason = "Non invoice balance removed from [$accountNumber]";
            }

            // store transaction
            $accountTransaction = AccountTransaction::create([
                'account_id' => $request->account['id'],
                'amount' => $request->amount,
                'reason' => $reason,
                'type' => $request->type,
                'transaction_date' => $request->date,
                'created_by' => auth()->user()->id,
                'note' => $request->note,
                'status' => $request->status,
            ]);

            // add activity log
            activity()
                ->causedBy(Auth::user())
                ->performedOn($accountTransaction)
                ->withProperties([
                    'name' => $reason,
                    'code' => '[' . $reason . ']',
                    'event' => 'Create',
                    'slug' => $accountTransaction->slug,
                    'routeName' => ''
                ])
                ->useLog('Balance Adjustment Created')
                ->log('Balance Adjustment Created');

            return $this->responseWithSuccess('Balance added successfully!');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $transaction = AccountTransaction::with('cashbookAccount')->where('slug', $slug)->first();

            return new AccountTransactionResource($transaction);
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $transaction = AccountTransaction::where('slug', $slug)->first();
        // validate request
        $this->validate($request, [
            'account' => 'required',
            'amount' => 'required|numeric|min:' . $transaction->amount,
            'date' => 'nullable|date_format:Y-m-d',
            'note' => 'nullable|string|max:255',
            'status' => 'required',
        ]);

        try {
            // generate reason
            $accountNumber = $request->account['accountNumber'];
            if ($request->type == 1) {
                $reason = "Non invoice balance added to [$accountNumber]";
            } else {
                $reason = "Non invoice balance removed from [$accountNumber]";
            }

            // update transaction
            $transaction->update([
                'amount' => $request->amount,
                'reason' => $reason,
                'type' => $request->type,
                'transaction_date' => $request->date,
                'note' => $request->note,
                'status' => $request->status,
            ]);

            // add activity log
            activity()
                ->causedBy(Auth::user())
                ->performedOn($transaction)
                ->withProperties([
                    'name' => "",
                    'code' => "",
                    'event' => 'Update',
                    'slug' => $transaction->slug,
                    'routeName' => ''
                ])
                ->useLog('Balance Adjustment Updated')
                ->log('Balance Adjustment Updated');

            return $this->responseWithSuccess('Balance updated successfully!');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $transaction = AccountTransaction::with('cashbookAccount')->where('slug', $slug)->first();
            if ($transaction->amount <= $transaction->cashbookAccount->availableBalance()) {

                // add activity log
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($transaction)
                    ->withProperties([
                        'name' => $transaction->reason,
                        'code' => '[' . $transaction->reason . ']',
                        'event' => 'Delete'
                    ])
                    ->useLog('Balance Adjustment Deleted')
                    ->log('Balance Adjustment Deleted');

                $transaction->delete();

                return $this->responseWithSuccess('Transaction deleted successfully');
            }

            return $this->responseWithError('Transaction can\'t be remove');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * search resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(Request $request)
    {
        $term = $request->term;
        $filterType = $request->filterType;

        $query = AccountTransaction::with('cashbookAccount', 'user')
            ->where('reason', 'LIKE', 'Non invoice balance added%');

        // Apply status filter
        if ($filterType === 'active') {
            $query->where('status', 1);
        } elseif ($filterType === 'inactive') {
            $query->where('status', 0);
        } elseif ($filterType === 'credit') {
            $query->where('type', 1);
        } elseif ($filterType === 'debit') {
            $query->where('type', 0);
        }

        // Apply search filters
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->orWhere('amount', 'LIKE', '%' . $term . '%')
                    ->orWhereHas('cashbookAccount', function ($subQuery) use ($term) {
                        $subQuery->where('bank_name', 'LIKE', '%' . $term . '%')
                            ->orWhere('account_number', 'LIKE', '%' . $term . '%');
                    });
            });
        }

        $results = $query->latest()->paginate($request->perPage);

        return AccountTransactionResource::collection($results);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allBalances()
    {
        $transactions = AccountTransaction::where('status', 1)->latest()->paginate(10);

        return AccountTransactionResource::collection($transactions);
    }
}
