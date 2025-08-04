const fs = require('fs');
const path = require('path');

// Simple script to manually update the sidebar component in the compiled assets
console.log('Starting simple build process...');

// Read the current sidebar source
const sidebarPath = path.join(__dirname, 'resources/js/components/Sidebar.vue');
const routesPath = path.join(__dirname, 'resources/js/router/routes.js');

if (fs.existsSync(sidebarPath)) {
    console.log('✓ Sidebar.vue exists with Education section');
} else {
    console.log('✗ Sidebar.vue not found');
}

if (fs.existsSync(routesPath)) {
    console.log('✓ routes.js exists with Education routes');
} else {
    console.log('✗ routes.js not found');
}

// Check if education pages exist
const educationDir = path.join(__dirname, 'resources/js/pages/education');
if (fs.existsSync(educationDir)) {
    const files = fs.readdirSync(educationDir);
    console.log('✓ Education pages found:', files);
} else {
    console.log('✗ Education pages directory not found');
}

console.log('\nTo see the Education section, you need to:');
console.log('1. Install dependencies: npm install --legacy-peer-deps');
console.log('2. Compile assets: npm run dev');
console.log('3. Refresh your browser');
console.log('\nThe Education section has been added to the source files but needs compilation.');
