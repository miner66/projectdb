function doCalc(){
	var bestelCode=document.getElementsByName("bestelCode");
	var prodNaam=document.getElementsByName("prodNaam");
	var minNum=document.getElementsByName("minNum");
	var numArt=document.getElementsByName("numArtikel");
	var linePrice=document.getElementsByName("linePrice");
	var lineCost=document.getElementsByName("lineCost");
	var orderLines=document.getElementById("orderLines");
	var percentage=document.getElementById("percentage");
	var costWithout=document.getElementById("costWithout");
	var costWith=document.getElementById("costWith");
	
	//calculate the total cost of a line
	for (i=0;i<numArt.length;i++){ 
		if(numArt[i].value>0){
			if(parseInt(numArt[i].value)>=parseInt(minNum[i].innerText)){
				lineCost[i].innerHTML =parseFloat(numArt[i].value*linePrice[i].innerHTML).toFixed(2);
			}else{
				lineCost[i].innerHTML =parseFloat(minNum[i].innerText*linePrice[i].innerHTML).toFixed(2);
			}
		}else{
			lineCost[i].innerHTML =parseFloat(numArt[i].innerText*linePrice[i].innerHTML).toFixed(2);
		}
	}	
	
	//show all the order lines where there is processing to do
	var allLines="";
	for(i=0;i<numArt.length;i++){
		if(numArt[i].value>0){
			allLines+="<tr><td>" + bestelCode[i].innerHTML + "</td><td>" + prodNaam[i].innerHTML + "</td>";
			if(parseInt(numArt[i].value)>=parseInt(minNum[i].innerText)){
				allLines+="<td>" + numArt[i].value + "</td>";
			}else{
				allLines+="<td>" + minNum[i].innerText + "</td>";
			}
			allLines+="<td>" + lineCost[i].innerHTML + "</td></tr>\n";
		}
	}
	
	orderLines.innerHTML=allLines;
	
	//calculate the total cost
	var totCost=0;
	for(i=0;i<numArt.length;i++){
		totCost+=parseFloat(lineCost[i].innerText);
	}
	costWithout.innerHTML=totCost.toFixed(2);
	costWith.innerHTML=parseFloat((totCost/100)*(100-percentage.innerText)).toFixed(2);
}