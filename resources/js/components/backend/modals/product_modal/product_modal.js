import axios from "axios";
import { Component } from "react";
import {Modal,Button} from 'react-bootstrap';
import BodyModalProduct from "./body_modal_product";
import HeaderModalProduct from "./header_modal_product";
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from "../../urls";
import { ceil } from "lodash";
import LoadingInline from "./LoadingInline";
// import BodyModalProduct from "./body_modal_product";
// import HeaderModalProduct from "./header_modal_product";


export default class ProductModal extends Component{
constructor()
{
    super()
                this.increment = 0;

    this.state = {
        isLoading:true,
        optionsCategories:[],
        optionsCities:[],
        objectProduct:{},
        loadSearch:false,
        customerId:0,
        trans:{
            "Product":"",
            "Product Name":"",
            "Product Price":"",
            "Total Price":"",
            "Save Changes":"",
            "Choose Country":"",
            "Tags":"",
            "Category":"",
            "Search":"",
            "Price":"",
            "Discount Price":"",
            "loading...":"",
            "Close":"",

        },
        hoverChooseCustomer:{},
        chooseCustomerClass:{
            background:"#aaa"
        },
        productDataArr:[],
        rows:[]
    }
}

componentDidMount(){


    this.callCategries();
    this.callTrans(this.state.trans);
}

callTrans(transes){

    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let  data_post = {
         data:transes,
          "_token": csrf_token
      }
    axios.post(Urls.static_url+"trans_data",data_post)
    .then(res=>{

        this.setState({
            trans:res.data,
            isLoading:false
        })
    })
    .catch(err=>{

    })
}

callCategries(){
    axios.get(Urls.static_url+"products/all_categories")
    .then(res=>{
        this.setState({
            optionsCategories:res.data.categories
        })
    })
    .catch(err=>{

    })
}
getDataProducts = (objProduct)=>{

    this.setState({
        loadSearch:true
    })
    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    objProduct["_token"] = csrf_token;
      objProduct["pagination"] = this.increment;

     axios.post(Urls.static_url+"products/getProducts",objProduct)
     .then(res=>{

         this.setState({
                rows:this.state.rows.concat(res.data.products) ,
                loadSearch:false

            })
               this.increment += 20;
     })
     .catch(err=>{
     })
}

handleAddDataProduct = (productData)=>{

    this.setState({
        productDataArr:[...this.state.productDataArr,productData]
    })

}


handleremoveDataProduct = (productData)=>{
    this.handleDelete(productData)
}


  handleDelete = productData => {
    const items = this.state.productDataArr.filter(item => item.id !== productData.id);
    this.setState({ productDataArr: items });
  };
  handleSaveChange = ()=>{

    this.props.saveChange(this.state.productDataArr);


    //   console.log({productDataArr:this.state.productDataArr});
  }
  componentDidUpdate(prevProps, prevState) {
    if (prevProps.clearData !== this.props.clearData) {
        // this.props.clearAllData()
        this.deleteAllData()
    }
  }

  deleteAllData = ()=>{
    this.setState({
        productDataArr:[]
    })

}
  closeModalProduct = ()=>{
      this.setState({
        productDataArr:[]
      })

  }

        handleScroll = (e) => {

          const bottom = ceil(e.target.scrollHeight - e.target.scrollTop)  === e.target.clientHeight;
          if (bottom) {
              this.getDataProducts({
                        name:"",
                        price:"",
                        category_id:"",
                        color:"",
                        tags:""
                    });
          } else {

    }
  }
render(){

            return(
                <div>
                <Modal size="lg" show={this.props.show} onHide={this.props.handleClose}>

                {this.state.isLoading?
                <div>
            <SkeletonTheme color="#fff"  highlightColor="#eee" >

<Modal.Header closeButton>
                <Modal.Title> <Skeleton  width={80} height={20}  /></Modal.Title>

                </Modal.Header>

                <Modal.Body>
                <div>
            <div className="container">

              <div className="row" style={{margin:10}}>

              <div className="col-2">
                 <Skeleton  width={40} height={30}  />
                 </div>
                  <div className="col-4">
                  <Skeleton  width={150} height={35}  />


                  </div>

                  <div className="col-4">
                  <Skeleton  width={150} height={35}  />


                  </div>


              </div>
              <div className="row" style={{margin:10}}>
                 <div className="col-4 offset-2">

                 <Skeleton  width={150} height={35}  />


                 </div>
                 <div className="col-4">
                 <Skeleton  width={150} height={35}  />


                 </div>
              </div>
              <div className="row" style={{margin:10}}>

                <div className="col-2 offset-10">
                <Skeleton  width={100} height={35}  />

                </div>

                </div>

          </div>
        </div>



                </Modal.Body>
                <Modal.Footer>
                <Skeleton  width={80} height={35}  />

                  <Skeleton  width={150} height={35}  />
                </Modal.Footer>

              </SkeletonTheme  >

                </div>:
                <div>

                <Modal.Header closeButton>
                <Modal.Title>{this.state.trans["Product"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>

            <HeaderModalProduct
                 getDataProducts={this.getDataProducts}
                 categories={this.state.optionsCategories}
                 loadSearch={this.state.loadSearch}
                 trans={this.state.trans}
                  />

                <div onScroll={this.handleScroll} style={{maxHeight:400,overflow:'auto'}}>

                    { this.state.rows.map((item,i)=>(
                        <div key={i}  style={{cursor:'pointer'}} >
                  <BodyModalProduct handleAddDataProduct={this.handleAddDataProduct} handleremoveDataProduct={this.handleremoveDataProduct}  trans={this.state.trans}  product={item} />

                        </div>

                    ))}
                    {this.state.loadSearch?<LoadingInline />:null}

                </div>

                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={()=>{
                      this.props.handleClose()
                      this.closeModalProduct()
                  }}>
                    {this.state.trans["Close"]}
                  </Button>
                  <Button onClick={this.handleSaveChange} variant="primary" >
                   { this.state.trans["Save Changes"] }{this.props.loadSearch?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                  </Button>
                </Modal.Footer>
                </div>}
              </Modal>

                </div>
            )
        }
    }

