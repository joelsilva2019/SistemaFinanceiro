var rel1 = new Chart(document.getElementById("rel1"), {
    
    type:'line',
    data: {
      labels:days_list,
      datasets:[{
              label:'Receita',
              data:revenue_list,
              fill:false,
              backgroundColor:'#0000FF',
              borderColor:'#0000FF'
      }]
    }
});

var rel2 = new Chart(document.getElementById("rel2"), {
    
    type:'pie',
    data:{
      labels:status_name_list,
      datasets: [{
              data:status_list,
              backgroundColor:['#FF9C19','#4169E1', '#FF0000']
              
      }]
        
    }
});



var rel3 = new Chart(document.getElementById("rel3"), {
    
    type:'bar',
    data: {
      labels:days_list,
      datasets:[{
              label:'Despesa',
              data:expanses_list,
              fill:false,
              backgroundColor:'#FF0000',
              borderColor:'#FF0000'
      }]
    }
});

var rel4 = new Chart(document.getElementById("rel4"), {
    
    type:'pie',
    data:{
      labels:status_name_list,
      datasets: [{
              data:status_purchase_list,
              backgroundColor:['#FF9C19','#4169E1', '#FF0000']
              
      }]
        
    }
});


