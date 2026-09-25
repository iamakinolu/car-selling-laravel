import React from 'react';
import {useForm} from '@inertiajs/react';
export default function CarForm({car=null,makers,types,fuelTypes}){
 const editing=!!car;
 const {data,setData,post,put,processing,errors}=useForm({maker:car?.maker||'',model:car?.model||'',year:car?.year||new Date().getFullYear(),car_type:car?.car_type||'',price:car?.price||'',vin:car?.vin||'',mileage:car?.mileage||0,fuel_type:car?.fuel_type||'',state:car?.state||'',city:car?.city||'',address:car?.address||'',phone:car?.phone||'',description:car?.description||'',features:car?.features||[],published:car?.published??true,images:[]});
 const opts=['Air Conditioning','Power Windows','Power Door Locks','ABS','Cruise Control','Bluetooth Connectivity','Remote Start','GPS Navigation','Heated Seats','Climate Control','Rear Parking Sensors','Leather Seats'];
 const submit=e=>{e.preventDefault();editing?put(`/cars/${car.id}`,{forceFormData:true}):post('/cars',{forceFormData:true});};
 const toggle=x=>setData('features',data.features.includes(x)?data.features.filter(y=>y!==x):[...data.features,x]);
 return <form onSubmit={submit} className="car-form">
  <div className="form-section"><h2>Vehicle Information</h2><div className="form-grid">
   <label>Maker<select value={data.maker} onChange={e=>setData('maker',e.target.value)}><option value="">Select maker</option>{makers.map(x=><option key={x}>{x}</option>)}</select>{errors.maker&&<small>{errors.maker}</small>}</label>
   <label>Model<input value={data.model} onChange={e=>setData('model',e.target.value)} placeholder="e.g. RX 200t"/>{errors.model&&<small>{errors.model}</small>}</label>
   <label>Year<input type="number" value={data.year} onChange={e=>setData('year',e.target.value)}/></label>
   <label>Type<select value={data.car_type} onChange={e=>setData('car_type',e.target.value)}><option value="">Select type</option>{types.map(x=><option key={x}>{x}</option>)}</select></label>
   <label>Price (₦)<input type="number" value={data.price} onChange={e=>setData('price',e.target.value)}/>{errors.price&&<small>{errors.price}</small>}</label>
   <label>VIN Code<input value={data.vin} onChange={e=>setData('vin',e.target.value)}/></label>
   <label>Mileage (km)<input type="number" value={data.mileage} onChange={e=>setData('mileage',e.target.value)}/></label>
   <label>Fuel Type<select value={data.fuel_type} onChange={e=>setData('fuel_type',e.target.value)}><option value="">Select fuel</option>{fuelTypes.map(x=><option key={x}>{x}</option>)}</select></label>
  </div></div>
  <div className="form-section"><h2>Location & Contact</h2><div className="form-grid">
   {['state','city','address','phone'].map(x=><label key={x}>{x.replace('_',' ').replace(/^\w/,c=>c.toUpperCase())}<input value={data[x]} onChange={e=>setData(x,e.target.value)}/></label>)}
  </div></div>
  <div className="form-section"><h2>Features</h2><div className="checkbox-grid">{opts.map(x=><label key={x}><input type="checkbox" checked={data.features.includes(x)} onChange={()=>toggle(x)}/> {x}</label>)}</div></div>
  <div className="form-section"><h2>Description & Photos</h2><label>Description<textarea rows="6" value={data.description} onChange={e=>setData('description',e.target.value)}/></label><label className="file-input">Photos<input type="file" multiple accept="image/*" onChange={e=>setData('images',Array.from(e.target.files))}/></label><label className="checkbox-label"><input type="checkbox" checked={data.published} onChange={e=>setData('published',e.target.checked)}/> Publish listing</label></div>
  <button className="button button-primary" disabled={processing}>{processing?'Saving...':editing?'Update Listing':'Publish Listing'}</button>
 </form>;
}
