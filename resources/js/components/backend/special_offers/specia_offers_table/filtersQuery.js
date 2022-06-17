import React from 'react'

export default function FiltersQuery({coulmns,handleChange,trans}) {


    // const  handleChange = (val){
    //     console.log({val});
    // }

    return (

<div className="row" style={{marginBottom:20}}>
          {coulmns.map(({FilterSql,accessor}) => {
              return(
                  <div key={accessor} style={{marginInline:10}}>
                  <FilterSql trans={trans}  handleChange={handleChange} type={accessor} width={130} />

                  </div>
              )
          }
          )}
    </div>

    )
}
