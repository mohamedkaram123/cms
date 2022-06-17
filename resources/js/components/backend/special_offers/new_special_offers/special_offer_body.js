import React from 'react'
import XToYBody from './specialOffersBody/x_to_y';
import CustomerPurchases from './specialOffersBody/customer_purchases';

export default function SpecialOfferBody({specialoffercheck,trans,optionsCategories,dataXTOY,dataFixedCustomerPurches,dataPercentCustomerPurches}) {


    if(specialoffercheck == 1){
        return (
            <div>
               <XToYBody dataXTOY={dataXTOY}  trans={trans} optionsCategories={optionsCategories} />
            </div>
        )
    }else{

        return(
            <div>
                <CustomerPurchases dataPercentCustomerPurches={dataPercentCustomerPurches} dataFixedCustomerPurches={dataFixedCustomerPurches} optionsCategories={optionsCategories} trans={trans} specialoffercheck={specialoffercheck} />
            </div>
        )

    }

}
