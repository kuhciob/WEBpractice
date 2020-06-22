
let isSimpleChordPaste=0;

//const ListSimple =document.getElementById('list1_Simple')
//const ListAbar =document.getElementById('list1_Abar')
//const ListEbar =document.getElementById('list1_Ebar')
const registration=document.getElementById('regiatration');

let inputTwoPlusTwo=document.createElement("input")
let inputtextTwoPlusTwo=document.createElement("input")
let guessBttn=document.getElementById('guessbutton');

inputTwoPlusTwo.class="reg_buttons"
inputTwoPlusTwo.type="submit"
inputTwoPlusTwo.value="Back"
inputTwoPlusTwo.style="font-size:1em; align-self:center;"
inputTwoPlusTwo.addEventListener('click',()=>BackToGuess())
inputtextTwoPlusTwo.type="text";

let attempts=0;
let counter=13;
let counter_value=0;
let songsArr=[
    { songimg :'images/songsbands/knebel.jpg', song_name : "Lindeman - Knebel", link:'knebel.html'},
    { songimg :'images/songsbands/madness.jpg', song_name : "Muse - Madness", link:'muse-madness.html'},
    { songimg :'images/songsbands/ac-dc-highway-to-hell.jpg', song_name : "AC/DC - Highway to hell", link:'acdchell.html'},
    { songimg :'images/songsbands/timeinabottle.jpg', song_name : "Jim Croce - Time In A Bottle", link:'timeinabottle.html'},
    { songimg :'images/songsbands/shortchangehero.jpg', song_name : "The Heavy - Short Change Hero", link:'shortchangehero.html'},
  
];

function SetConfig(){
    document.getElementById("SignInBlock").style.visibility="hidden";
    document.getElementById("CurrentUserBlock").style.visibility="hidden";
    
    readTextFile("/php/config.json", function(text){
    let data = JSON.parse(text);
    var currentuser = data.currentuser;
    if(currentuser.username==""){
        document.getElementById("SignInBlock").style.visibility="visible";
        document.getElementById("currusername").innerHTML=""
        document.getElementById("CurrentUserBlock").remove();

    }
    else
    {
        document.getElementById("CurrentUserBlock").style.visibility="visible";
        document.getElementById("SignInBlock").remove();
        document.getElementById("currusername").innerHTML=currentuser.username;
        console.log(currentuser)
        
    }

    if(currentuser.isadmin=="1"){
        let adref=document.createElement("a");
        adref.innerHTML="admin panel"
        
        adref.href= window.location.origin+"/layouts/admin.html"
        adref.className="btn btn-warning btn-sm w-100";
        document.getElementById("CurrentUserBlock").appendChild(document.createElement("br"))
        document.getElementById("CurrentUserBlock").appendChild(adref)
    }
    });
}

function ShowPost(postname){
    top.location.href = '/php/showpost.php?postname='+postname;
}

function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}


function AddSongItems(nodename ,Arr){
    for(let i=0;i<songsArr.length;++i){
        let item=document.createElement('tr');       
        node=document.getElementById(nodename);
        node.append(item);
        item.class='songtable';

        let info=Arr[i];

        let img_th=document.createElement('th');
        img_th.style.width="min-content"
        let img=document.createElement('img');
        

        img.className='songimg';
        img.src=info.songimg;
        img.style.height='20em';
        img.style.width='20em';
        img_th.append(img); 
        
        let songname_ref=document.createElement('a');
        let songname=document.createElement('h2');
        songname.style.textAlign="left"
        let song_name_th=document.createElement('th');
        song_name_th.style="width: 100%;";
        songname_ref.className='song_name';
        songname_ref.href=info.link;
        songname_ref.target='_blank';
        songname_ref.innerHTML=info.song_name;
        songname_ref.style="margin-left: 10%; vertical-align: middle;margin-left: 10%;width: max-content;";
        song_name_th.style="width:max-content;";
        songname.append(songname_ref)
        song_name_th.append(songname);

        item.append(img_th);
        item.append(song_name_th);    
    }


}


function PasteImg(listID ,name){
   if(isSimpleChordPaste){
        let img_for_rem=document.getElementById('SimpleChords');
        img_for_rem.remove();
        isSimpleChordPaste=0;
    }else{
        let img=document.createElement('img');
        img.src=name;
        img.id='SimpleChords';
        let list_el=document.getElementById(listID);
        list_el.after(img);
        isSimpleChordPaste=1;
   }
}
function Registration(){
    
    let div =document.createElement('div');
    div.style=" position: fixed; top:20%;background-color: rgba(153, 140, 153, 0); width:100%; display: flex; flex-direction: column;z-index:100;";
    let RegBlock=document.createElement('div');
    RegBlock.className="Registration";
    div.id="RegBlock";
    
    div.append(RegBlock);

    let FORM;
    FORM=document.createElement('form');
    FORM.id="RegistrationForm"
    FORM.method="post"
    FORM.action=""
//---------------------------------
    let tmp=document.createElement('h2');
    tmp.innerHTML="Registration";
    tmp.style.color="color:white";
    tmp.style.fontSize="2.5em";
    FORM.append(tmp);

    tmp=document.createElement('br');
    FORM.append(tmp);
    
//---------------------------------
// USRNAME
//---------------------------------
    tmp=document.createElement('h2');
    tmp.innerHTML="Username";
    RegBlock.append(tmp);

    tmp=document.createElement('br');
    RegBlock.append(tmp);

    
    let input=document.createElement('input');
    input.type="text";
    input.name="regusername"
    input.id="regusername"
    FORM.append(input);
    

    tmp=document.createElement('br');
    FORM.append(tmp);
//---------------------------------
//  PASSWORD
//---------------------------------
    tmp=document.createElement('h2');
    tmp.innerHTML="Password";
    FORM.append(tmp);

    input=document.createElement('input');
    input.type="text";
    input.name="regpass"
    input.id="regpass"
    const resultEl=input;
    FORM.append(input); 

    tmp=document.createElement('br');
    FORM.append(tmp);
    
//---------------------------------
    tmp=document.createElement('h2');
    tmp.innerHTML="Confirm Password";
    FORM.append(tmp);

    input=document.createElement('input');
    input.type="text";
    input.id="regpassconfirm"
    const resultElconfirm = input;
    FORM.append(input);
    

    tmp=document.createElement('br');
    FORM.append(tmp);   
    
//---------------------------------
// generate password button
//---------------------------------
let button=document.createElement('small');
button.id="genPassBttn"

//button.className='reg_buttons';
button.style.fontSize="50%"
button.style.alignSelf="center"
button.style.margin=0;
button.innerHTML="generate password";
button.style.cursor="pointer"



    // button.addEventListener('click', ()=>{
    //     const length = 10;
    //     const hasLower = true;
    //     const hasUpper = true;
    //     const hasNumber =true;
    //     const hasSymbol = true;
        
    //     //resultEl.innerText = GeneratePassword(hasLower, hasUpper, hasNumber, hasSymbol, length);
    //     resultEl.value=GeneratePassword(hasLower, hasUpper, hasNumber, hasSymbol, length);
    //     resultElconfirm.value=resultEl.value;
    // })
    
    FORM.append(button);
//RegBlock.append(button);
//---------------------------------
// buttons
//---------------------------------

    tmp=document.createElement('div');
    tmp.style="text-align: center;width: -webkit-fill-available;";

    button=document.createElement('button');
    button.className='reg_buttons';
    button.innerHTML="close";
    button.addEventListener('click',()=>{div.remove()});
    tmp.append(button);
    
    button=document.createElement('a');
    button.style.cursor="pointer"
    button.className='reg_buttons';
    button.innerHTML="sign up";
    button.addEventListener('click',()=>{ SignUp( FORM.id); });
    tmp.append(button);

    
        
    FORM.append(tmp);

    document.getElementsByTagName('body')[0].after(div);

    RegBlock.append(FORM);
    //RegBlock.show()
}

const randomFunc = {
	lower: getRandomLower,
	upper: getRandomUpper,
	number: getRandomNumber,
	symbol: getRandomSymbol
}


function GeneratePassword(lower, upper, number, symbol, length) {
	let generatedPassword = '';
	const typesCount = lower + upper + number + symbol;
	const typesArr = [{lower}, {upper}, {number}, {symbol}].filter(item => Object.values(item)[0]);
    
    
	// Doesn't have a selected type
	if(typesCount === 0) {
		return '';
	}
	
	// create a loop
	for(let i=0; i<length; i+=typesCount) {
		typesArr.forEach(type => {
			const funcName = Object.keys(type)[0];
			generatedPassword += randomFunc[funcName]();
		});
	}
	
	const finalPassword = generatedPassword.slice(0, length);

	return finalPassword;
}
function getRandomLower() {
	return String.fromCharCode(Math.floor(Math.random() * 26) + 97);
}

function getRandomUpper() {
	return String.fromCharCode(Math.floor(Math.random() * 26) + 65);
}

function getRandomNumber() {
	return +String.fromCharCode(Math.floor(Math.random() * 10) + 48);
}

function getRandomSymbol() {
	const symbols = '!@#$%^&*(){}[]=<>/,.'
	return symbols[Math.floor(Math.random() * symbols.length)];
}

function SignUp(formid){
    var responsecode=0;

    let FORM = document.getElementById(formid)
    let username = FORM.elements[0].value;
    let password = FORM.elements[1].value;
    if( password != FORM.elements[2].value ){
        alert("passwords must be match")
        window.event.preventDefault();
        return;
    }
    if( password=="" || password==null){
        alert("passwords can`t be empty")
        window.event.preventDefault();
        return;
    }
    let xhr = new XMLHttpRequest();
    let data = JSON.stringify({
        username: username ,
        password: password
        });
                        xhr.open("POST", "php/signup.php", true);
                        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
                        xhr.send(data);


                        xhr.onerror = function() { 
                        alert("ERROR!!");
                        };
                        xhr.onload = function() {
                            if (xhr.status != 200) { 
                                alert(`Помилка: ${xhr.status}: ${xhr.statusText}`); 
                            } else { 
                                responsecode=xhr.response;
                                
                            }
                            switch(responsecode){
                                case "001": alert("user is allready registraited");break;
                                case "200": 
                                    alert("Hello, "+ username+ ", nice to meet you!! ");
                                    document.getElementById("RegBlock").remove();
                                    break;
                        };
                        console.log(responsecode)
       



        }

}
function validateLoginForm(evt){
    validateForm(evt,"SignInForm","username","password")
}
function validateForm(evt,formname,name,pass)
{
    let Event = evt || window.event;
    FieldIsEmpty(Event,formname,name)
    FieldIsEmpty(Event,formname,pass)
  
}
function FieldIsEmpty(Event, formname, inputname){
    let data=document.forms[formname][inputname].value;
    if (data==null || data=="")
    { 
        document.forms[formname][inputname].setAttribute("style","background-color: rgba(255, 0, 0, 0.397);")
        Event.returnValue = false;
        alert("Field "+inputname + " is empty");
        if(Event.preventDefault) Event.preventDefault();
        return false;
    }
    else{
        document.forms[formname][inputname].setAttribute("style","background-color: rgba(153, 153, 153, 0);") 
    }
}


function validateLogin(evt, formname, inputname) {
    let theEvent = evt || window.event;
    let data=document.forms[formname][inputname].value;
    if (data!=null || data!="")
       document.forms[formname][inputname].setAttribute("style","background-color: rgba(153, 153, 153, 0);") 
    //Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    let regex = /[0-9a-zA-Z]|\_/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
    
}
function validatePassword(evt, formname, inputname) {
    let theEvent = evt || window.event;
    let data=document.forms[formname][inputname].value;
    if (data!=null || data!="")
        document.forms[formname][inputname].setAttribute("style","background-color: rgba(153, 153, 153, 0);") 
    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    let regex = /[0-9a-zA-Z]|\@| \# | \$ /;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
    

}




//==================================================
//---------------------------------------------------
class ArtifactRendedrer {
    static buildTag(
      {
        type = "div",
        classes = [],
        innerHTML = "",
        children = []
      } = {}
    ) {
      let tag = document.createElement(type);
  
      tag.classList.add(...classes)
      tag.innerHTML = innerHTML;
  
      children.forEach(child => tag.appendChild(child));
  
      return tag;
    }
  
    constructor(artifact) {
      this.artifact = artifact;
    }
  
    render(parent_div) {
    //   let container_div = ArtifactRendedrer.buildTag({
    //     classes: ["songtable"],
    //     children: [this.buildArtifact_div()],
    //   });
  
      //parent_div.appendChild(container_div);
      parent_div.appendChild(this.buildArtifact_div());
      
    }
  
    buildArtifact_div() {
      return ArtifactRendedrer.buildTag({
          type:"tr",
        classes: ["songitem"],
        children: [
            this.buildImage_div(),
            this.buildHeader_div(),
        ],
      });
    }

    buildHeader_div() {
        let songname=document.createElement('a');
        songname.className='song_name';
        //songname.href=info.link;
        songname.target='_blank';
        songname.innerHTML=this.artifact.song_name;
        songname.style="margin-left: 10%; ";

      return ArtifactRendedrer.buildTag({
            type:"th",
            classes: ["song_conteirner_th"],
            children: [songname]
      });
    }
  

    buildImage_div() {
      let img = ArtifactRendedrer.buildTag({type: "img"});
      img.src = this.artifact.image_url;
      img.className='songimg';
      img.style.height='100px';
      img.style.width='100px';
  
      return ArtifactRendedrer.buildTag({
            type:"th",
            classes: [],
            children: [img]
      });
    }
  }
  
 function GetContentFromServer(){
    const ARTIFACTS_CONTAINER_DIV = document.getElementById("songs_items_conteiner_div");
    const SONGS_TABLE=document.createElement("table")
    SONGS_TABLE.className="songtable";
    const API_BASE = "http://localhost:3000"
    
    let url = `${API_BASE}/artifacts`;

    fetch(url)
    .then(response => response.json())
    .then(artifacts => {
      artifacts.forEach(
        artifact =>
          new ArtifactRendedrer(artifact).render(SONGS_TABLE)
      );
    });
    ARTIFACTS_CONTAINER_DIV.appendChild(SONGS_TABLE)
 } 
  


//-------------------------------------------------------
