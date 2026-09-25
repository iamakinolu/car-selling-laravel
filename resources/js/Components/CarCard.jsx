import React from 'react';
import {Link,router,usePage} from '@inertiajs/react';
export default function CarCard({car,favorite=false}){
 const {auth}=usePage().props;
 const fav=e=>{e.preventDefault();e.stopPropagation();if(!auth.user)return router.visit('/login');router.post(`/cars/${car.id}/favorite`,{},{preserveScroll:true});};
 return <article className="car-card"><Link href={`/cars/${car.id}`} className="car-card-image-wrap">
  <img src={car.image_url} className="car-card-image" alt={`${car.maker} ${car.model}`}/><button className={`favorite-button ${favorite?'active':''}`} onClick={fav}><i className={favorite?'fas fa-heart':'far fa-heart'}/></button>
 </Link><div className="car-card-body"><div className="flex-between"><span className="badge">{car.year}</span><span className="text-muted">{Number(car.mileage).toLocaleString()} km</span></div>
 <h3><Link href={`/cars/${car.id}`}>{car.maker} {car.model}</Link></h3><p className="car-location"><i className="fas fa-map-marker-alt"/> {car.city||'Nigeria'}{car.state?`, ${car.state}`:''}</p>
 <div className="flex-between car-price-row"><strong>₦{Number(car.price).toLocaleString()}</strong><span>{car.fuel_type||'—'}</span></div></div></article>;
}
