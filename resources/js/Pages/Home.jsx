import React,{useState} from 'react';
import {Head,Link,router} from '@inertiajs/react';
import Layout from '../Components/Layout';
import CarCard from '../Components/CarCard';
export default function Home({cars,filters,makers,models,types,fuelTypes}){
 const [f,setF]=useState(filters||{});const set=(k,v)=>setF({...f,[k]:v});
 const submit=e=>{e.preventDefault();router.get('/',f,{preserveState:true,replace:true});};
 return <Layout><Head title="Find Your Next Car"/><section className="hero"><div className="container hero-content"><div className="hero-copy"><span className="eyebrow">THE SMARTER WAY TO BUY & SELL</span><h1>Find a car you'll <span>love.</span></h1><p>Browse trusted listings from sellers around Nigeria and find your next ride.</p><Link href="/sell" className="button button-primary">Sell Your Car</Link></div><img src="/images/car-png-39071.png" className="hero-car" alt=""/></div></section>
 <section className="container search-panel"><form onSubmit={submit}><div className="search-grid">
 <select value={f.maker||''} onChange={e=>set('maker',e.target.value)}><option value="">Maker</option>{makers.map(x=><option key={x}>{x}</option>)}</select>
 <select value={f.model||''} onChange={e=>set('model',e.target.value)}><option value="">Model</option>{models.map(x=><option key={x}>{x}</option>)}</select>
 <select value={f.car_type||''} onChange={e=>set('car_type',e.target.value)}><option value="">Type</option>{types.map(x=><option key={x}>{x}</option>)}</select>
 <select value={f.fuel_type||''} onChange={e=>set('fuel_type',e.target.value)}><option value="">Fuel Type</option>{fuelTypes.map(x=><option key={x}>{x}</option>)}</select>
 <input type="number" placeholder="Year From" value={f.year_from||''} onChange={e=>set('year_from',e.target.value)}/><input type="number" placeholder="Year To" value={f.year_to||''} onChange={e=>set('year_to',e.target.value)}/>
 <input type="number" placeholder="Price From" value={f.price_from||''} onChange={e=>set('price_from',e.target.value)}/><input type="number" placeholder="Price To" value={f.price_to||''} onChange={e=>set('price_to',e.target.value)}/>
 <button className="button button-primary"><i className="fas fa-search"/> Search</button></div></form></section>
 <section className="container section"><div className="section-heading"><div><span className="eyebrow">OUR INVENTORY</span><h2>Latest Cars</h2></div><span className="text-muted">{cars.total} vehicles found</span></div>
 {cars.data.length?<div className="cars-grid">{cars.data.map(c=><CarCard key={c.id} car={c}/>)}</div>:<div className="empty-state"><i className="fas fa-car-side"/><h3>No cars found</h3><p>Try changing your filters.</p></div>}
 <div className="pagination">{cars.links.map((l,i)=>l.url?<Link key={i} href={l.url} className={l.active?'active':''} dangerouslySetInnerHTML={{__html:l.label}}/>:<span key={i} dangerouslySetInnerHTML={{__html:l.label}}/>)}</div></section></Layout>;
}
