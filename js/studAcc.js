document.addEventListener('DOMContentLoaded',()=>{
    

    document.addEventListener('onclick',{
        
    })
    getsec('#homebtn')
    getsec('viewbtn')
    
    getsec('#requestbtn')

    

    
    
    document.querySelector('#logbtn').onclick= ()=>{
        getsec('#logbtn')
        let mess =confirm('Do you want to log out?')
        if(mess){
            document.write('you clicked yes')
            
        }

    }

    
})


function getsec(btn,id){
    let elem= document.querySelector(btn).onclick =()=>{

        document.querySelector('#home').style.display = 'none'
        document.querySelector(id).style.display = 'unset'

    }

}