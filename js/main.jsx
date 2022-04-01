var cart = [];
function addProduct(ID,QTY,prezzo,nome){
        cart= cart.filter((obj)=>{
          return obj.id != ID;
        })
        cart.push(new preOrder(ID,QTY,nome,prezzo));       
        addCookie("cart","/","localhost",JSON.stringify(cart));
  }
  class Cart extends React.Component {
    constructor(props) {
        super(props);
        this.state = {  
          
        }
    }
    reRender = ()=>{
      this.forceUpdate();
    }
    render() { 
      var c = JSON.parse(getCookie("cart"))
      return ( 
          <div className="cart-box">
             <table>
               <tbody>
                <tr><td>Numero</td><td>:</td><td>{c.length}</td></tr>
                  <tr><td>Costo</td><td>:</td><td>92€</td></tr>
               </tbody>  
              </table>
              <div className="shop" onMouseOver={this.reRender}>
                  <img className="cart-img" alt="" src="img/cart.png"></img>
                  <div className="cart-preview">
                      <Rows></Rows>
                  </div>
              </div> 
          </div>
       );
    }
}
function Rows() {
    if(!get_cookie("cart")){
      return false;
    }
    var c = JSON.parse(getCookie("cart"));
    return ( 
        c.map((r)=>{
            return(
                <div className="cart-row" key={r.id}>
                    <img src="img/based.jpg" alt=""></img>
                    <div className="info">
                        <p>{r.nome}</p>
                        <b>{r.prezzo + '€'}</b>
                    </div>
                    <div className="total">
                        <p>{r.qty + 'x'}</p>
                        <p>{r.qty*r.prezzo + '€'}</p>
                    </div>
                    <a>x</a>
                </div>
            )
        })
     );
}
  class Counter extends React.Component{
      constructor(props){
          super(props);
          this.state={
              QTY:0
          };
      }   
      render(){
          return(
          <div className="divconta">
              <button onClick={()=>this.setState({QTY: Math.max(this.state.QTY-1,0)})}>-</button>
              <p>{this.state.QTY}</p>
              <button onClick={()=>this.setState({QTY:this.state.QTY+1})}>+</button>
          </div>
          )
      }
  }
  class Wallet extends React.Component{
    render(){
      return(
        <div>
          <button className="button" onClick={()=>{
            const l = this.props.c.current;
            addProduct(this.props.id,l.state.QTY,this.props.prezzo,this.props.nome)}}>
            <span className="button__text">Compra</span>
            <svg className="button__svg" role="presentational" viewBox="0 0 600 600">
              <defs>
                <clipPath id="myClip">
                  <rect x="0" y="0" width="100%" height="50%" />
                </clipPath>
              </defs>
              <g clipPath="url(#myClip)">
                <g id="money">
                  <path d="M441.9,116.54h-162c-4.66,0-8.49,4.34-8.62,9.83l.85,278.17,178.37,2V126.37C450.38,120.89,446.56,116.52,441.9,116.54Z" fill="#699e64" stroke="#323c44" strokeMiterlimit="10" strokeWidth="14" />
                  <path d="M424.73,165.49c-10-2.53-17.38-12-17.68-24H316.44c-.09,11.58-7,21.53-16.62,23.94-3.24.92-5.54,4.29-5.62,8.21V376.54H430.1V173.71C430.15,169.83,427.93,166.43,424.73,165.49Z" fill="#699e64" stroke="#323c44" strokeMiterlimit="10" strokeWidth="14" />
                </g>
                <g id="creditcard">
                  <path d="M372.12,181.59H210.9c-4.64,0-8.45,4.34-8.58,9.83l.85,278.17,177.49,2V191.42C380.55,185.94,376.75,181.57,372.12,181.59Z" fill="#a76fe2" stroke="#323c44" strokeMiterlimit="10" strokeWidth="14" />
                  <path d="M347.55,261.85H332.22c-3.73,0-6.76-3.58-6.76-8v-35.2c0-4.42,3-8,6.76-8h15.33c3.73,0,6.76,3.58,6.76,8v35.2C354.31,258.27,351.28,261.85,347.55,261.85Z" fill="#ffdc67" />
                  <path d="M249.73,183.76h28.85v274.8H249.73Z" fill="#323c44" />
                </g>
              </g>
              <g id="wallet">
                <path d="M478,288.23h-337A28.93,28.93,0,0,0,112,317.14V546.2a29,29,0,0,0,28.94,28.95H478a29,29,0,0,0,28.95-28.94h0v-229A29,29,0,0,0,478,288.23Z" fill="#a4bdc1" stroke="#323c44" strokeMiterlimit="10" strokeWidth="14" />
                <path d="M512.83,382.71H416.71a28.93,28.93,0,0,0-28.95,28.94h0V467.8a29,29,0,0,0,28.95,28.95h96.12a19.31,19.31,0,0,0,19.3-19.3V402a19.3,19.3,0,0,0-19.3-19.3Z" fill="#a4bdc1" stroke="#323c44" strokeMiterlimit="10" strokeWidth="14" />
                <path d="M451.46,435.79v7.88a14.48,14.48,0,1,1-29,0v-7.9a14.48,14.48,0,0,1,29,0Z" fill="#a4bdc1" stroke="#323c44" strokeMiterlimit="10" strokeWidth="14" />
                <path d="M147.87,541.93V320.84c-.05-13.2,8.25-21.51,21.62-24.27a42.71,42.71,0,0,1,7.14-1.32l-29.36-.63a67.77,67.77,0,0,0-9.13.45c-13.37,2.75-20.32,12.57-20.27,25.77l.38,221.24c-1.57,15.44,8.15,27.08,25.34,26.1l33-.19c-15.9,0-28.78-10.58-28.76-25.93Z" fill="#7b8f91" />
                <path d="M148.16,343.22a6,6,0,0,0-6,6v92a6,6,0,0,0,12,0v-92A6,6,0,0,0,148.16,343.22Z" fill="#323c44" />
              </g>
  
            </svg>
          </button>
        </div>
      )
    }
  }
  
  class Card extends React.Component{
      constructor(props){
          super(props);
          this.counter = React.createRef()
      }
      render(){
          return(
              <div className="card">
                  <img id={this.props.id} src={this.props.img}></img>
                      <p>{this.props.testo}</p>
                      <div className="btn_holder">
                          <Counter ref={this.counter} prezzo={this.props.prezzo} nome={this.props.nome}></Counter>                    
                          <Wallet id={this.props.id} c={this.counter} prezzo={this.props.prezzo} nome={this.props.nome}></Wallet>
                      </div>
              </div>
          )
      }
  }
  ReactDOM.render(<Cart></Cart>,document.querySelector('#carrello'));
  var prodotti;
  $.ajax({
    url: "/backend/product.php",
    data: {
      REQTYPE:"Random",
    },
    success: function( result ) {
      //console.log(result);
      genCards();
    }
  });
  function genCards(){
      const domContainer = document.querySelector('#main');
      $.ajax({
          url: "/backend/product.php",
          data: {
            REQTYPE:"Get",
          },
          success: function( result ) {
            console.log(result);
            let prodotti=JSON.parse(result);
            ReactDOM.render(
              prodotti.map((p)=>{return <Card key={p.COD} nome={p.NOME} id={p.COD} img={p.LINK} testo={p.DES} prezzo={p.PREZZO}></Card>}),domContainer
            )
            if(!get_cookie("COOK")){
              $('button').prop('disabled', true);
            }else{
              $("button").removeAttr("disabled");
            }
          }
      });
  }
  
  