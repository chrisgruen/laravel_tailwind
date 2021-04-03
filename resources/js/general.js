 /*Toggle dropdown list*/
 /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/
  
 var leftMenuDiv = document.getElementById("menu-content");
 var leftMenu = document.getElementById("menu-toggle");
 
 document.onclick = check;
 
 function check(e){
   var target = (e && e.target) || (event && event.srcElement);
    
   //Main Menu
   if (!checkParent(target, leftMenuDiv)) {
 	// click NOT on the menu
 	if (checkParent(target, leftMenu)) {
 	  // click on the link
 	  if (leftMenuDiv.classList.contains("hidden")) {
 		leftMenuDiv.classList.remove("hidden");
 	  } else {leftMenuDiv.classList.add("hidden");}
 	} else {
 	  // click both outside link and outside menu, hide menu
 	  leftMenuDiv.classList.add("hidden");
 	}
   }
   
 }
 
 function checkParent(t, elm) {
   while(t.parentNode) {
 	if( t == elm ) {return true;}
 	t = t.parentNode;
   }
   return false;
 }