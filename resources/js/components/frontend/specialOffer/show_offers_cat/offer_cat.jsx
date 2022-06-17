import React,{useState,useRef,useEffect} from 'react';



export default function Offer_cat({item}) {

            const [trans, settrans] = useState({

            })

       const mounted = useRef(false);
            useEffect(() => {
            if (!mounted.current) {
              array_columns_images_categores()

            mounted.current = true;
            } else {


            }
            }, []);

            const [isLoading, setisLoading] = useState(true)
    const [ColumnsArrayCategory, setColumnsArrayCategory] = useState([])

   const  array_columns_images_categores = () => {
        switch(item.cats.length) {
  case 1:
    setColumnsArrayCategory([12])
    break;
  case 2:
   setColumnsArrayCategory([6, 6])
       break;
  case 3:
    setColumnsArrayCategory([4,4, 4])
        break;
   case 4:
    setColumnsArrayCategory([4,4,4])
        break;

  default:
    setColumnsArrayCategory([4,4,4])

}
}




          return (
                     <div>
            <div className="carousel-box">

                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        {/* <img className="card-img-top" src="https://source.unsplash.com/daily" alt="Card image top" /> */}
                    <div className="card-header">
                                <h6>{item.offer.offer_title}</h6>


                             </div>
                    <div className="card-body">
                        <div className="row" >
                        {ColumnsArrayCategory.map((col,i) => (

                            <div  key={i}  className={"col-" + col} >
                                        <img src={item.cats[i].banner} className="img-thumbnail" style={{height:250,width:"100%"}}  />
                            </div>


                        ))}
                        </div>

                    </div>
                    <div className="card-footer">
                                       <p className="card-text" style={{color:"#333",fontSize:14,fontWeight:600}}>{ item.msg_offer}</p>

                    </div>
                    </div>
            </div>
        </div>
             )



       }
