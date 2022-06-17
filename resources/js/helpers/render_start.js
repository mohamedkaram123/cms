import React from 'react'

export default function RenderStart({ rating, maxRating = 5 }) {


    const fullStar = <i className='las la-star active'></i>;
    const halfStar = <i className='las la-star half'></i>;
    const emptyStar = <i className='las la-star '></i>;

    const ratings = rating <= maxRating ? rating : maxRating;


     const  fullStarCount =  parseInt(ratings) ;
        const halfStarCount = Math.ceil(ratings)  - fullStarCount;
    const emptyStarCount = maxRating - fullStarCount - halfStarCount;

const items = []

    for (let i = 0; i < fullStarCount;i++) {
  items.push(<i key={i+Math.random()} className='las la-star active'></i>)
    }


    for (let i = 0; i < halfStarCount;i++) {
  items.push(<i key={i+Math.random()} className='las la-star half'></i>)
}

    for (let i = 0; i < emptyStarCount;i++) {
  items.push(<i key={i+Math.random()} className='las la-star '></i>)
}



    return (
        <div>
      { items}
        </div>
    )
}
