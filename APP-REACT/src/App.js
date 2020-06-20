import React, { Component } from 'react';
import axios from 'axios';

  class App extends Component {
   
    constructor() {
      super();
      this.createBook = this.createBook.bind(this);
      this.writeState = this.writeState.bind(this);
      this.edit = this.edit.bind(this);
   //this.eliminar = this.eliminar.bind(this);
   this.state = {
          books:[],
          id:'',
          title:'',
          author:'',
          synopsis:'',
          price:'',
          stock:'',
          envio:true
      };
    }

    componentDidMount() {
      this.getBooks();
    
   }

async getBooks() {
  try {
    const res = await axios.get('http://localhost/React_crud/RestApi_PHP/obtener.php');
    console.log(res.data)
        this.setState({
            books:res.data
          })
        
     } catch (error) {
       console.error(error);
     }
    }

async createBook(e) {
   e.preventDefault();
   
  try {
    if(this.state.envio){
    const {title, author, synopsis, price, stock} = this.state;
    const obj1 = {title:title, author:author, synopsis:synopsis, price:price, stock: stock };
    await axios.post('http://localhost/React_crud/RestApi_PHP/crear.php',obj1);
    
     }else{
      const {id, title, author, synopsis, price, stock} = this.state;
      const obj2 = {id:id, title:title, author:author, synopsis: synopsis, price: price, stock: stock};
      await axios.post('http://localhost/React_crud/RestApi_PHP/modificar.php',obj2);
     
     }
      
       } catch (error) {
        console.error(error);
      }
     this.setState({
        id:'',
        title:'',
        author:'',
        synopsis:'',
        price:'',
        stock:'',
        envio:true,
     })
     this.getBooks();
    }

    writeState(e) {
     const {name , value} = e.target;
     this.setState({
      [name]:value
       });
     }

   async delete(e,id) {
      e.preventDefault();
      const obj = {id:id}; 
      try {
     
        if(window.confirm("esta seguro de querer elinarlo")){
          await axios.post('http://localhost/React_crud/RestApi_PHP/eliminar.php',obj); 
          this.getBooks();
        }
         
       } catch (error) {
        console.error(error);
      }
    }
    
async edit(e, id){
  e.preventDefault();
  const obj = {id:id}; 
  try {
    const res = await axios.post('http://localhost/React_crud/RestApi_PHP/obtenerUno.php',obj);
    console.log(res);
    this.setState({
      id:res.data[0].id,
      title:res.data[0].title,
      author:res.data[0].author,
      synopsis:res.data[0].synopsis,
      price:res.data[0].price,
      stock:res.data[0].stock,
      envio:false
    });    
    console.log(res);
        this.getBooks();
       } catch (error) {
        console.error(error);
      }
    }

   
 render(){
      return(

    <div className="container p-4">
      <nav className="navbar navbar-dark bg-dark mb-2">
  <span className="navbar-brand mb-0 h1">CRUD-REACT-PHP-MYSQL</span>
      </nav>
      <form onSubmit={this.createBook}>
        <input type="text"  name="title"   onChange={this.writeState} 
        value={this.state.title} placeholder="title"/>

        <input type="text" name="author"  onChange={this.writeState} 
        value={this.state.author} placeholder="author"/>

        <input type="text"  name="synopsis" onChange={this.writeState}
        value={this.state.synopsis} placeholder="synopsis"/>

        <input type="number"  name="price" onChange={this.writeState}
        value={this.state.price} placeholder="price"/>

        <input type="number"  name="stock" onChange={this.writeState}
        value={this.state.stock} placeholder="stock"/>

        <input type="submit" className="btn btn-success" value="Submit" />
      </form>   
       <div className="row p-3">
           
            {
             this.state.books.map(item=>{
               return (
                
                 <div className="card p-2 m-2" key={item.id}>
                  <img  width="60" src="logo192.png" alt="img"></img>
                   <div className="card-body">
                    <h6>{item.title}</h6>
                    <h6>{item.author}</h6>
                    <h6>{item.synopsis}</h6>
                    <h6>{item.price}</h6>
                    <h6>{item.stock}</h6>
                 <button className="btb btn-danger mx-2"
                 onClick={(e)=>this.delete(e,item.id)}>delete</button>
                 <button className="btb btn-info"
                 onClick={(e)=>this.edit(e,item.id)}>edit</button>
                 </div>
                 
                 </div>
               )
            })
            }

              </div>
          </div>
         
      );
  
  }
};
export default App;