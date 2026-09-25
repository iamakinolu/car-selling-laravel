import '../css/app.css';
import React from 'react';
import {createRoot} from 'react-dom/client';
import {createInertiaApp} from '@inertiajs/react';
import './bootstrap';
createInertiaApp({
 title:t=>`${t} · Car Findal`,
 resolve:name=>import.meta.glob('./Pages/**/*.jsx',{eager:true})[`./Pages/${name}.jsx`].default,
 setup({el,App,props}){createRoot(el).render(<App {...props}/>);}
});
