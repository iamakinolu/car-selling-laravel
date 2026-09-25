import React from 'react';
import {Head,Link,router,usePage} from '@inertiajs/react';
import Layout from '../../Components/Layout';
export default function Show({car,isFavorite}){
 const {auth}=usePage().props;const fav=()=>auth.user?router.post(`/cars/${car.id}/favorite`,{},{preserveScroll:true}):router.visit('/login');
 return <Layout><Head title={`${car.maker} ${car.model}`}/><div className="container section"><div className="breadcrumb"><Link href="/">Cars</Link> / {car.maker} {car.model}</div>
 <div className="car-detail-grid"><div><div className="main-car-image"><img src={car.image_url} alt=""/></div><div className="thumb-grid">{(car.images||[]).map((x,i)=><img key={i} src={`/storage/${x}`} alt=""/>)}</div></div>
 <div className="car-detail-info"><div className="flex-between"><span className="badge">{car.year}</span><button className={`favorite-button ${isFavorite?'active':''}`} onClick={fav}><i className={isFavorite?'fas fa-heart':'far fa-heart'}/></button></div>
 <h1>{car.maker} {car.model}</h1><div className="detail-price">₦{Number(car.price).toLocaleString()}</div>
 <div className="spec-grid"><div><span>Mileage</span><strong>{Number(car.mileage).toLocaleString()} km</strong></div><div><span>Fuel</span><strong>{car.fuel_type||'—'}</strong></div><div><span>Type</span><strong>{car.car_type||'—'}</strong></div><div><span>Location</span><strong>{car.city||'—'}</strong></div></div>
 <h3>Description</h3><p>{car.description||'No description provided.'}</p><h3>Features</h3><div className="feature-list">{(car.features||[]).map(x=><span key={x}><i className="fas fa-check"/> {x}</span>)}</div>
 <div className="seller-box"><strong>Seller: {car.seller?.name}</strong><span>{car.phone||car.seller?.email}</span><span>{car.address}</span><a className="button button-primary" href={`tel:${car.phone||''}`}><i className="fas fa-phone"/> Contact Seller</a></div></div></div></div></Layout>;
}
