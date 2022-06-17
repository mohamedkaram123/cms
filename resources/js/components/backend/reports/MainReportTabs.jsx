import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faTruck,faCartArrowDown,faUser, faTshirt,faWallet, faUserTag, faStreetView } from '@fortawesome/free-solid-svg-icons'

import React, { Component } from 'react'
import { Tab, TabList, TabPanel, Tabs } from 'react-tabs'
import CustomerReport from './main_reports/cutomers_report/customer_report'
import OrderReport from './main_reports/orders_report/orders_report'
import ProductSales from './main_reports/products_report/product_report'
import SalesReport from './main_reports/sales_report/sales_report'
import VisitsReport from './main_reports/visits_report/visits_report'
import BodyOptions from './main_reports/body_options'
import ErrorConnection from "../../errors/error_connect";
import LoadingInline from './LoadingInline'
import Slider from 'react-slick'
import SamplePrevArrow from './sliderComponents/PrevArrow'
import SliderBtns from './sliderComponents/SliderBtns'
import SearchReport from './main_reports/search_report/search_report'
export default class MainReportTabs extends Component{

    constructor(){

        super();
//    this.customeSlider = createRef();

   this.messagesEndRef = React.createRef()

       this.settings = {
      dots: true,
      infinite: true,
      speed: 500,
      slidesToShow: 3,
           slidesToScroll: 1,

    };
        //   const isTabletOrMobile = useMediaQuery({ query: '(max-width: 600px)' })
    this.isTabletOrMobile =  window.matchMedia("(max-width: 768px)").matches ;

        console.log({mob:this.isTabletOrMobile});
        this.state={
            classTab:{
                fontSize:20,padding:10,fontWeight:400,paddingInline:30
            },
            selectdClass:{

                color:"#fff"
            },
            index: 0,
            loadingBtn: "",
            loadDataSales: false,
            loadDataProduct: false,
            loadDataSalesProduct: false,
            loadDataSalesBrands: false,
            loadDataSalesCategories: false,
            loadDataAbanfonedBaskets: false,
            loadDataSalesCoupons:false,

            start_date:new Date().setDate((new Date()).getDate()-90),
            end_date: new Date(),
            option: "summary",
            type: "sales",
            errorLoad:false
        }


    }


    convertDate(date_covert){
        let date = new Date(date_covert);
            date = date.getUTCFullYear() + '-' +
         ('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
         ('00' + date.getUTCDate()).slice(-2) + ' ' +
         ('00' + date.getUTCHours()).slice(-2) + ':' +
         ('00' + date.getUTCMinutes()).slice(-2) + ':' +
         ('00' + date.getUTCSeconds()).slice(-2);
         return date;
    }

    handleOptionsChoose = (option, type) => {

        this.setState({
               option,
            type
        })

    }
    sales_products
    handleclickShow = (type) => {

        if (type == "sales") {

           switch(this.state.option) {
                    case "summary":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSales:true
                        })
                        break;
                    case "sales_products":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesProduct:true
                        })
                    break;
                      case "sales_brands":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesBrands:true
                        })
                   break;
                    case "sales_categories":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesCategories:true
                        })
                   break;
                    case "sales_coupons":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesCoupons:true
                        })
                   break;

                    default:
                        // code block
                    }

        } else if (type == "product") {
            if (this.state.option == "products_quantity") {
               this.setState({
                    loadingBtn: "product",
                    loadDataProduct:true
                })
            } else if (this.state.option == "abandoned_baskets") {
                 this.setState({
                    loadingBtn: "product",
                    loadDataAbanfonedBaskets:true
                })
            }

        }

    }
    data_is_start_load = (type) => {

            if (type == "sales") {
                   switch(this.state.option) {
                    case "summary":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSales:false
                        })
                        break;
                    case "sales_products":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesProduct:false
                        })
                    break;
                    case "sales_brands":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesBrands:false
                        })
                    break;
                    case "sales_categories":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesCategories:false
                        })
                    break;
                    case "sales_coupons":
                    this.setState({
                            loadingBtn: "sales",
                            loadDataSalesCoupons:false
                        })
                   break;
                    default:
                        // code block
                    }

        } else if (type == "product") {
                        if (this.state.option == "products_quantity") {
               this.setState({
                    loadingBtn: "product",
                    loadDataProduct:false
                })
            } else if (this.state.option == "abandoned_baskets") {
                 this.setState({
                    loadingBtn: "product",
                    loadDataAbanfonedBaskets:false
                })
            }

        }
//    this.setState({
//              loadingBtn: true,
//               loadDataSales:false
//         })
    }
    data_is_reached = (type) => {

            if (type == "sales") {
                   switch(this.state.option) {
                    case "summary":
                    this.setState({
                            loadingBtn: "",
                            loadDataSales:false
                        })
                        break;
                    case "sales_products":
                    this.setState({
                            loadingBtn: "",
                            loadDataSalesProduct:false
                        })
                    break;
                    case "sales_brands":
                    this.setState({
                            loadingBtn: "",
                            loadDataSalesBrands:false
                        })
                    break;
                    case "sales_categories":
                    this.setState({
                            loadingBtn: "",
                            loadDataSalesCategories:false
                        })
                    break;
                    case "sales_coupons":
                    this.setState({
                            loadingBtn: "",
                            loadDataSalesCoupons:false
                        })
                   break;
                    default:
                        // code block
                    }

        } else if (type == "product") {
                            if (this.state.option == "products_quantity") {
               this.setState({
                    loadingBtn: "",
                    loadDataProduct:false
                })
            } else if (this.state.option == "abandoned_baskets") {
                 this.setState({
                    loadingBtn: "",
                    loadDataAbanfonedBaskets:false
                })
            }

        }

        //    this.setState({
        //     loadingBtn: false,
        //     //  loadDataSales:false
        // })
    }

    prevScroll = () => {
             this.selectIndex(2)
    }
    nextScroll = () => {

    }
        handleErrorLoad() {
          this.setState({
                errorLoad:true
            })
        }
    selectIndex = (index) => {
 $(".btn-slick-slide").removeClass("active-slick")
                        if (index == 0) {
                            this.setState({
                                option:"summary"
                            })
                        } else if (index == 1) {
                             this.setState({
                                option:"products_quantity"
                             })

                        }

                            this.setState({
                                index
                            })
    }
    render() {
        if (!this.state.errorLoad) {
               if(this.props.isLoading){
            return (
             <LoadingInline />
            )
        } else {

                //style={}={ this.isTabletOrMobile?"text-center":""}
            return (
                <div  >

                    <Tabs selectedIndex={this.state.index} onSelect={index => {
                           if (index == 0) {
                            this.setState({
                                option:"summary"
                            })
                        } else if (index == 1) {
                             this.setState({
                                option:"products_quantity"
                             })

                        }

                            this.setState({
                                index
                            })
                    }}>
                        <div className="card">
                                <SliderBtns setindex={this.selectIndex} trans={this.props.trans} />

                            <div className="card-header d-none" style={{ justifyContent: "center" }}>



                                {/* <div>
                                    <button onClick={this.prevScroll} className='btn btn-primary'>{"<"}</button>
                                    <button onClick={this.nextScroll} className='btn btn-primary'>{">"}</button>
                                </div> */}

                                <TabList  id='tablist'  className={this.isTabletOrMobile?" wrapper_Reports_tabs  d-none":"d-none"}   >
                                            <Tab className="col-md-2 col-12 btn react-tabs__tab d-flex flex-inline slider__item"
                                                style={{ marginInline: 10,borderRadius:0,justifyContent:'center',alignItems:'center' }}>

                                            </Tab>
                                            <Tab className="col-md-2 col-12 btn react-tabs__tab d-flex flex-inline slider__item"
                                                style={{ marginInline: 10,borderRadius:0,justifyContent:'center',alignItems:'center' }}>

                                            </Tab>
                                            <Tab className="col-md-2 col-12 btn react-tabs__tab d-flex flex-inline slider__item"
                                                style={{ marginInline: 10,borderRadius:0 ,justifyContent:'center',alignItems:'center'}}>

                                            </Tab>
                                            <Tab className="col-md-2 col-12 btn react-tabs__tab d-flex flex-inline slider__item"
                                                style={{ marginInline: 10,borderRadius:0,justifyContent:'center',alignItems:'center' }}>

                                            </Tab>
                                            <Tab className=" col-md-2 col-12 btn react-tabs__tab d-flex flex-inline slider__item"
                                                style={{ marginInline: 10 ,borderRadius:0,justifyContent:'center',alignItems:'center'}}>

                                    </Tab>
                                    <Tab className=" col-md-2 col-12 btn react-tabs__tab d-flex flex-inline slider__item"
                                                style={{ marginInline: 10 ,borderRadius:0,justifyContent:'center',alignItems:'center'}}>

                                    </Tab>
                                    <Tab className=" col-md-2 col-12 btn react-tabs__tab d-flex flex-inline slider__item"
                                                style={{ marginInline: 10 ,borderRadius:0,justifyContent:'center',alignItems:'center'}}>

                                    </Tab>

                                </TabList>

                                </div>

                            <div className="card-body">
                                <div className="row">
                                    <BodyOptions
                                        loadingBtn={this.state.loadingBtn}
                                        handleclickShow={this.handleclickShow}
                                        index={this.state.index}
                                        trans={this.props.trans}
                                        handleOptionsChoose={this.handleOptionsChoose}
                                    />
                                </div>
                            </div>
                                </div>

                                <TabPanel>
                                        <SalesReport
                                            data_is_reached={this.data_is_reached}
                                            data_is_start_load={this.data_is_start_load}
                                            loadDataSales={this.state.loadDataSales}
                                            loadDataSalesProduct={this.state.loadDataSalesProduct}
                                            loadDataSalesBrands={this.state.loadDataSalesBrands}
                                            loadDataSalesCategories={this.state.loadDataSalesCategories}
                                            loadDataSalesCoupons={this.state.loadDataSalesCoupons}
                                            option={this.state.option}
                                            start_date={this.convertDate(this.props.start_date)}
                                            end_date={this.convertDate(this.props.end_date)}
                                            handleErrorLoad={this.handleErrorLoad}
                                        />
                                </TabPanel>

                                <TabPanel>
                                <ProductSales
                                    handleErrorLoad={this.handleErrorLoad}
                                    data_is_reached={this.data_is_reached}
                                    loadDataAbanfonedBaskets={this.state.loadDataAbanfonedBaskets}
                                    data_is_start_load={this.data_is_start_load}
                                    loadDataProduct={this.state.loadDataProduct}
                                    option={this.state.option}
                                    start_date={this.convertDate(this.props.start_date)}
                                    end_date={this.convertDate(this.props.end_date)} />
                                </TabPanel>

                                <TabPanel>
                                    <CustomerReport
                                        handleErrorLoad={this.handleErrorLoad}
                                        start_date={this.convertDate(this.props.start_date)}
                                        end_date={this.convertDate(this.props.end_date)} />
                                </TabPanel>

                                <TabPanel>
                                    <VisitsReport
                                        handleErrorLoad={this.handleErrorLoad}
                                        start_date={this.convertDate(this.props.start_date)}
                                        end_date={this.convertDate(this.props.end_date)} />
                                </TabPanel>

                                <TabPanel>
                                    <OrderReport
                                        handleErrorLoad={this.handleErrorLoad}
                                        start_date={this.convertDate(this.props.start_date)}
                                        end_date={this.convertDate(this.props.end_date)} />
                                </TabPanel>
                                <TabPanel>
                                    <SearchReport
                                        handleErrorLoad={this.handleErrorLoad}
                                        start_date={this.convertDate(this.props.start_date)}
                                        end_date={this.convertDate(this.props.end_date)} />
                                </TabPanel>

                                <TabPanel>

                                </TabPanel>
                          </Tabs>


                </div>
            )
        }
        } else {
                              return (
                      <ErrorConnection />
                )
        }


    }

}
