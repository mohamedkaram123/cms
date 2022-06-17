import React, { useState } from 'react'
import { Editor } from 'react-draft-wysiwyg';
import '../../../../../..//node_modules/react-draft-wysiwyg/dist/react-draft-wysiwyg.css';
import { Urls } from '../../urls';


export default function BodySmsModal({ trans, setValue , onContentStateChange }) {

const addStr=  (str, index, stringToAdd)=>{
  return str.substring(0, index) + stringToAdd + str.substring(index, str.length);
}

    const [ContentLength, setContentLength] = useState(0)
        const [PartLength, setPartLength] = useState(0)
        const [Content, setContent] = useState("")
        const [EnterLength, setEnterLength] = useState(0)

    const ContentSms = (e) => {

        setContent(e.target.value);
        setContentLength(Content.length);
        setPartLength(Math.round(ContentLength / 320) + 1);
        if (ContentLength == 0) {
            setPartLength(0)
        }




    }

    const ContentEnter = (e) => {

                  let content = Content;

                    if (e.key === 'Enter') {


                        content += e.key ;
                        setContent(content)
                    const regex = /\n/g;
                       let found = content.match(regex);

                        setEnterLength(found.length)

                    }

                setContentLength(Content.length);
        let Contentlength = Content.length;
             if (Contentlength == 0) {
            setPartLength(0)
        }
                       const regex = /\n/g;
                       let found = (content.match(regex) || []);
                        setEnterLength(found.length)

        onContentStateChange(Content,"sms_content")


    }
    return (
        <div>

            <div className="row">
                <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Sms Provider']}</label>
                                <select className="form-control" onChange={setValue.bind(this,"sms_provider")}>
                                    <option value="provider_fekra">{trans["SMS Fekra"]}</option>


                                </select>

                    </div>
                </div>


            </div>
            <div className="row">


                <div className="col-12 d-flex flex-column">

                    <div className="form-group p-2">
                                <label className="col-from-label">{trans['Content']}</label>

                        <textarea className="form-control" rows={5} onChange={ContentSms} onKeyUp={ContentEnter}  />
                    </div>
                    <div className="p-2 d-flex flex-row" style={{justifyContent:"space-around"}}>
                        <span>{trans["Count"]} : { ContentLength}</span>
                        <span>{trans["Parts"]} : {PartLength}</span>
                         <span>{trans["Enter Count"]} : { EnterLength}</span>
                    </div>

                </div>
            </div>

        </div>
    )
}
