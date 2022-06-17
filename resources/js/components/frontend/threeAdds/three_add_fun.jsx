import React,{useRef,useEffect,useState} from 'react'
import { useSpring, animated ,useChain} from 'react-spring'
import { Urls } from '../../backend/urls';

export default function ThreeAddFun({ id,showThreeFun,trans }) {

            const [transformSpring1, settransformSpring1] = useState(`translate(-100%, 0)`)
            const [transformSpring2, settransformSpring2] = useState(`translate(-100%, 0)`)
            const [transformSpring3, settransformSpring3] = useState(`translate(-100%, 0)`)
    const fade1 = useSpring({
        transform: transformSpring1,
            config: { duration: 100 },
})

       const fade2 = useSpring({
        transform: transformSpring2,
            config: { duration: 200 },
})

       const fade3 = useSpring({
        transform: transformSpring3,
            config: { duration: 300 },
})


    const mounted =  useRef(false)
    useEffect(() => {

        if (!mounted.current) {



            mounted.current = true;
        } else {


            if (showThreeFun.id == id) {
                                    settransformSpring1(`translate(10%, 0)`)
                                    settransformSpring2(`translate(10%, 0)`)
                                    settransformSpring3(`translate(10%, 0)`)


            } else {
                                settransformSpring1(`translate(-100%, 0)`)
                                settransformSpring2(`translate(-100%, 0)`)
                                settransformSpring3(`translate(-100%, 0)`)

            }

        }
    }, [showThreeFun])


    // const addToWishList = (id)=>{
    //     if (auth && user.user_type == 'customer' || user.user_type == 'seller') {
    //         $.post(Urls.url + "wishlists/store", { _token: AIZ.data.csrf, id: id }, function (data) {
    //             if (data != 0) {
    //                 $('#wishlist').html(data);
    //                 AIZ.plugins.notify('success', trans['Item has been added to wishlist']);
    //             }
    //             else {
    //                 AIZ.plugins.notify('warning', trans['Please login first'] );
    //             }
    //         });
    //     }else {
    //                             AIZ.plugins.notify('warning', trans['Please login first'] );

    //         }


    //     }

    // const  showAddToCartModal = (id)=>{
    //         if(!$('#modal-size').hasClass('modal-lg')){
    //             $('#modal-size').addClass('modal-lg');
    //         }
    //         $('#addToCart-modal-body').html(null);
    //         $('#addToCart').modal();
    //         $('.c-preloader').show();
    //         $.post( Urls.url + "cart/show-cart-modal", {_token: AIZ.data.csrf, id:id}, function(data){
    //             $('.c-preloader').hide();
    //             $('#addToCart-modal-body').html(data);
    //             AIZ.plugins.slickCarousel();
    //             AIZ.plugins.zoom();
    //             AIZ.extra.plusMinus();
    //             getVariantPrice();
    //         });
    //     }


    return (
        <div>
            <div >
                <div className="d-flex flex-column">
                                <animated.div style={fade1}><button onClick={()=>{
                                    addToWishList(id)
                                }}  className="aiz-hover-a"  data-toggle="tooltip" data-title={trans["Add to wishlist"]} data-placement="left">
                                    <i className="la la-heart-o"></i>
                                </button></animated.div>
                                <animated.div style={fade2}><button onClick={()=>{
                                    addToCompare(id)
                                }}    className="aiz-hover-a" data-toggle="tooltip" data-title={ trans['Add to compare']} data-placement="left">
                                    <i className="las la-sync"></i>
                                </button></animated.div>
                                <animated.div style={fade3}><button onClick={()=>{
                                    showAddToCartModal(id)
                                }}   className="aiz-hover-a"  data-toggle="tooltip" data-title={ trans['Add to cart'] } data-placement="left">
                                    <i className="las la-shopping-cart"></i>
                                </button></animated.div>
                            </div>
           </div>
        </div>
    )
}
