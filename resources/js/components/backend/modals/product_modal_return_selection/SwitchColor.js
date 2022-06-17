'use strict'

import React from 'react'
import { TwitterPicker  } from 'react-color'

class ButtonExample extends React.Component {
  state = {
    displayColorPicker: false,
    color:"#fff",
    firstColor:"#FF6900",
    colors:['#FF6900', '#FCB900', '#7BDCB5', '#00D084', '#8ED1FC', '#0693E3', '#ABB8C3', '#EB144C', '#F78DA7', '#9900EF']
  };

  handleClick = () => {
    this.setState({ displayColorPicker: !this.state.displayColorPicker })
  };

  handleClose = () => {
    this.setState({ displayColorPicker: false })
  };

  render() {
    const popover = {
      position: 'absolute',
      zIndex: '2',
    }
    const cover = {
      position: 'fixed',
      top: '0px',
      right: '0px',
      bottom: '0px',
      left: '0px',
    }
    return (
      <div>
        <button className="btn btn-icon btn-light" onClick={ this.handleClick }><i className="las la-palette"></i></button>
        { this.state.displayColorPicker ? <div style={ popover }>
          <div style={ cover } onClick={ this.handleClose }/>
          <TwitterPicker colors={this.state.colors} color={this.state.color} onChangeComplete={e=>{

             this.state.colors[0] = e.hex;
             this.setState({
                  color:e.hex,
                  colors:this.state.colors
              })
            this.props.handleChangeColor(e.hex)
          }}  />
        </div> : null }
      </div>
    )
  }
}

export default ButtonExample
