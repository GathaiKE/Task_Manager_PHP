let input = document.getElementById("task")
let updateBtn = document.getElementById("submit")

function preload(id){
    let xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            input.value = this.responseText
        }
    }
    xmlHttp.open("GET","fetch_single.php?id="+id,true);
    xmlHttp.send();

    updateBtn.value = "Update"
}



function delete_task(id){
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function () {
        if(this.readyState == 4 && this.status == 200){
            let task = document.getElementById("task-"+id)
            
            if(task){
                task.remove();
            }
        }
    }
    xmlhttp.open("POST","delete_task.php?id="+id,true);
    xmlhttp.send();
}

const fetchRecords = ()=>{

    let xmlhttp = new XMLHttpRequest();

    // xmlhttp.onreadystatechange=()=>{
    //     if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    //         let tasks = JSON.parse(xmlhttp.response)

    //         console.log(tasks);
            
    //         const ul = document.getElementById("list")
    //         ul.innerHTML = "";

    //         tasks.forEach(task=>{
    //             const li = document.createElement("li");
    //             li.textContent = task

    //             ul.appendChild(li);
    //         })
    //     }
    // }

    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                let tasks = JSON.parse(xmlhttp.response);
                console.log(tasks);
    
                const ul = document.getElementById("list");
                ul.innerHTML = "";
    
                tasks.forEach(task => {
                    const li = document.createElement("li");
                    li.textContent = task;
    
                    ul.appendChild(li);
                });
            } else {
                console.error("Error: " + xmlhttp.status + " - " + xmlhttp.statusText);
            }
        }
    };
    

    xmlhttp.open("GET","fetch_all.php",true);
    xmlhttp.send();
}

window.addEventListener("load",fetchRecords)

