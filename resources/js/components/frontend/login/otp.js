import React, { Component, useEffect, useRef, useState } from "react";
import ReactDOM from "react-dom";
import OtpInput from "react-otp-input";
// import OTPInput, { ResendOTP } from "otp-input-react";
// import CssBaseline from "@material-ui/core/CssBaseline";
import Typography from "@material-ui/core/Typography";
import Container from "@material-ui/core/Container";
import { makeStyles, useTheme } from "@material-ui/core/styles";
import Paper from "@material-ui/core/Paper";
import Grid from "@material-ui/core/Grid";
// import LockOutlinedIcon from "@material-ui/icons/LockOutlined";
import Avatar from "@material-ui/core/Avatar";
import Button from "@material-ui/core/Button";
import CssBaseline from "@material-ui/core/CssBaseline";
import TextField from "@material-ui/core/TextField";
import Skeleton, { SkeletonTheme } from "react-loading-skeleton";
import axios from "axios";
import { Urls } from "../../backend/urls";
// import "./styles.css";

const useStyles = makeStyles(theme => ({
  grid: {
    backgroundColor: "grey",
    height: "50vh",
    textAlign: "center"
  },
  avatar: {
    margin: theme.spacing(1),
    backgroundColor: theme.palette.secondary.main
  },
  submit: {
    margin: theme.spacing(3, 0, 2)
  },
  paper: {
    marginTop: theme.spacing(8),
    display: "flex",
    flexDirection: "column",
    alignItems: "center"
  }
}));

export default function Otp() {
       const [isLoading, setisLoading] = useState(true)

    const [trans, settrans] = useState({
        "customer reviews":""
    })


          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

                callTrans(trans)
        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);



     const  callTrans = (transes)=>{

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data_post = {
            data: transes,
            "_token": csrf_token
        }
        axios.post(Urls.static_url + "trans_data", data_post)
            .then(res => {


                settrans(res.data)

            })
            .catch(err => {

            })
    }

    if (isLoading) {
        return (
            <div>
                <SkeletonTheme color="#fff" highlightColor="#eee" >
                    <div className="text-center border rounded p-2 mt-3">
                        <div className="rating">
                            <Skeleton width="50%" height="1%" />
                        </div>
                        <div className="opacity-60 fs-12"><Skeleton width="70%" height="2%" /></div>
                    </div>
                </SkeletonTheme>
            </div>

        )
    } else {

    }
}

