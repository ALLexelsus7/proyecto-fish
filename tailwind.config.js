import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    // Esta es una ORDEN DIRECTA. No permite borrar estas clases en el NPM RUN BUILD
    safelist: [
        'tarjeta-cristal',
        'tarjeta-cristal-2',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },          
            // rescato y agrego mis colores personalizados para el proyecto
            colors: { 
                'mar-profundo': '#1C3B4A',
                'niebla-costera': '#A8B3B8',
                'madera-humeda': '#937d64',
                'luz-de-linterna': '#F7E59E',
                'terror-submarino': '#5F2936',
                'coral-electrico': '#00D2E1',
                'ojo-aberracion': '#FFC800',
                'magma-diablillo': '#E84A27',
                'fosforescencia-abisal': '#8A4FFF',
                'mangle-toxico': '#7DBE2E',
                'box-shadow': '0 .5rem 1.5rem rgba(0,0,0,.1)',
                'border': '.2rem solid rgba(0,0,0,.1)',
                'outline': '.1rem solid rgba(0,0,0,.1)',
                'outline-hover': '.2rem solid rgba(255, 255, 255, 0.247)',
                'text-shadow': '0 .5rem 1rem rgba(0,0,0,.5)',
                'drop-shadow1': 'drop-shadow(0px 0px 10% #FCF8EC)',
                'drop-shadow2': 'drop-shadow(0px 0px 5px #FAF0D0)',
                'drop-shadow3': 'drop-shadow(0px 0px 10px #F7E59E)',
                'drop-shadow4': 'drop-shadow(0px 0px 10px #E8D58D)',
                'drop-shadow5': 'drop-shadow(0px 0px 10px #D3C37D)',
            },
        },
    },

    plugins: [forms],
};
