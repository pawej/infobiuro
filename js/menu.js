//keywords
var code="code";var url="url";var sub="sub";
//styles
var color = {"border":"#666666", "shadow":"#DBD8D1", "bgON":"white","bgOVER":"#ffff66"};
var color1 = {"border":"#666666", "shadow":"#DBD8D1", "bgON":"#003399","bgOVER":"#ffff66"};

var css = {"ON":"clsCMOn", "OVER":"clsCMOver"};
var STYLE = {"border":1, "shadow":2, "color":color, "css":css};
var STYLE_C = {"border":1, "shadow":2, "color":color1, "css":css};
//items and formats
var MENU_ITEMS_IB =
[
	{"pos":[0,0], "style":STYLE, "leveloff":[24,0], "itemoff":[0,89]},
	{code:"Start", "format":{"size":[25,90]}, url:"index.php?m=start"},
		{code:"Klienci", "format":{"size":[25,90]},
					
				
					sub:[
					{"itemoff":[24,0]}, 
					{code:"Lista", "format":{"size":[25,150]}, url:"index.php?m=klienci"},
					{code:"Dodaj klienta", "format":{"size":[25,150]}, url:"index.php?m=dodaj_klienta"},
					{code:"Wystawianie faktur", "format":{"size":[25,150]}, url:"index.php?m=wyst_faktur"},
					{code:"P³atnoœci", "format":{"size":[25,150]}, url:"index.php?m=zaplaty"},
				
					
		]
	},


		{code:"Ustawienia", "format":{"size":[25,90]},
					
				
					sub:[
					{"itemoff":[24,0]}, 
					{code:"U¿ytkownicy", "format":{"size":[25,150]}, url:"index.php?m=user"},
					{code:"Abonamenty", "format":{"size":[25,150]}, url:"index.php?m=abo"},
				
					
		]
	},

	{code:"Wydruki", "format":{"size":[25,90]},
					
				
					sub:[
					{"itemoff":[24,0]}, 
					


					{code:"D³u¿nicy", "format":{"size":[25,150]}, url:"javascript:openWin('dluznicy.php','wykres','width=770,height=500,toolbar=0,status=1,menuBar=0,scrollBars=1,left=0,top=0')"},

				
					
		]
	},
	
	

	{code:"Wyloguj", "format":{"size":[25,90]}, url:"index.php?m=wyloguj"},

];
