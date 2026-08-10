import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins:[
        laravel({
            input:[
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh:true,
        }),
    ],
});
// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css', 
//                 'resources/js/app.js',
//                 'resources/js/side_bar.js',
//             ],
//             refresh: true,
//         }),
//         tailwindcss(),
//     ],
    
// });

// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';

// export default defineConfig({
//     server: {
//         host: '0.0.0.0',
//         port: 5173,
//         strictPort: true,
//         hmr: {
//             host: '192.168.43.5', // သင့် PC IP
//         },
//     },

//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js',
//                 'resources/js/video-call/app.js',
//             ],
//             refresh: true,
//         }),
//         tailwindcss(),
//     ],
// });



