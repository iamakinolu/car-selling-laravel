import React from 'react';
import {Link,usePage} from '@inertiajs/react';
export default function Layout({children}){
 const {auth,flash}=usePage().props;
 return <>
  <header className="navbar"><div className="container navbar-content">
   <Link href="/" className="logo-wrapper"><img src="/images/logoipsum-265.svg" alt="Car Findal"/></Link>
   <nav className="navbar-nav"><Link href="/">Browse Cars</Link>
   {auth.user?<><Link href="/dashboard">My Cars</Link><Link href="/favorites">Watchlist</Link><Link href="/sell" className="button button-primary">Sell a Car</Link><Link href="/logout" method="post" as="button" className="nav-button">Logout</Link></>:<><Link href="/login">Login</Link><Link href="/register" className="button button-primary">Sign Up</Link></>}</nav>
  </div></header>
  {flash?.success&&<div className="container"><div className="alert alert-success">{flash.success}</div></div>}
  {flash?.error&&<div className="container"><div className="alert alert-error">{flash.error}</div></div>}
  <main>{children}</main><footer className="footer"><div className="container">© {new Date().getFullYear()} Car Findal · Laravel + React</div></footer>
 </>;
}
