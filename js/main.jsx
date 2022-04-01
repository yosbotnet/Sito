var cart = [];
function addProduct(ID,QTY,prezzo,nome){
        cart= cart.filter((obj)=>{
          return obj.id != ID;
        })
        cart.push(new preOrder(ID,QTY,nome,prezzo));       
        addCookie("cart","/","localhost",JSON.stringify(cart));
}
function checkout(){
  console.log("scam");
}
function removeProduct(ID){
  cart= cart.filter((obj)=>{
    return obj.id != ID;
  })
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
    var sum = 0;
    c.forEach(i => {
      sum += parseInt(i.prezzo);
    });
    return ( 
        <div className="cart-box">
           <table>
             <tbody>
              <tr><td>Numero</td><td>:</td><td>{c.length}</td></tr>
                <tr><td>Costo</td><td>:</td><td>{sum+'€'}</td></tr>
             </tbody>  
            </table>
            <div className="shop" onMouseOver={this.reRender}>
                <img className="cart-img" alt="" src="img/cart.png"></img>
                <div className="cart-preview">
                    <Rows></Rows>
                    <a className="c" onClick={()=>checkout()}>Checkout</a>
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
                    <a onClick={()=>removeProduct(r.id)}>x</a>
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
              <button className="cnt" onClick={()=>this.setState({QTY: Math.max(this.state.QTY-1,0)})}>-</button>
              <p className="cnt">{this.state.QTY}</p>
              <button className="cnt" style={{marginRight:"0px"}} onClick={()=>this.setState({QTY:this.state.QTY+1})}>+</button>
          </div>
          )
      }
  }
  class Wallet extends React.Component{
    render(){
      return(
        <div>
          <button className="bt" onClick={()=>{
            const l = this.props.c.current;
            addProduct(this.props.id,l.state.QTY,this.props.prezzo,this.props.nome)}}>
              Compra
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
  
  