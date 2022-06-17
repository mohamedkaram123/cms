import axios from 'axios';
import { Component } from 'react';
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';
import 'react-tabs/style/react-tabs.css';
import EgyptTab from './EgyptTab';
import SaudiTab from './SaudiTab';
import Skeleton, { SkeletonTheme } from "react-loading-skeleton";
import LoadPayTabs from './LoadPayTabs';
import { Urls } from '../../urls';

let inc = 0;
export default class RouterPayTabs extends Component{

    constructor(){
        super();

        this.state = {
            "Paytabs Credential":"",
            isLoading:true
        }
    }


    componentDidMount(){
        this.lang("Paytabs Credential")
    }

    lang(key) {

        let lang = "";



        axios.get('trans/' + key)
        .then( (response) => {



            this.setState({
                "Paytabs Credential":response.data,
                isLoading:false


            })

        })
        .catch(function (error) {
        // handle error
        console.log(error);
        });

        return lang;
    }

componentDidUpdate(){
    this.lang("Paytabs Credential")
}
    render(){

        if(this.state.isLoading){

            return(

                <LoadPayTabs />

                )

        }else{
            return(
                <div className="card">

                <Tabs>
                <div className="card-header">

                        <TabList>
                      <Tab><img src={ Urls.public_url + "assets/img/flags/eg.svg"} height="20" width="40"/> </Tab>
                      <Tab><img src={ Urls.public_url + "assets/img/flags/sa.svg"} height="20" width="40"/> </Tab>
                    </TabList>

                    <h5>{this.state["Paytabs Credential"]}</h5>
                        </div>

                        <div className="card-body">
                        <TabPanel>


                     <EgyptTab />

                    </TabPanel>
                    <TabPanel>

                          <SaudiTab />
                    </TabPanel>
                        </div>

                  </Tabs>
                    </div>
            )

        }



    }
}


