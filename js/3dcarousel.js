var count = 0; 
var baseSpeed = 0.01; 
var radiusX = 430; 
var radiusY = 100; 
var centerX = 650; 
var centerY = 150;
var speed = 0.2;
var imageDivs = '';
var numberOfElements = '';
var carousel = '';
var speedTest = '';


window.addEvent('domready', function(){
  
	carousel = $('carousel');
	speedTest = $('speedTest');

	imageDivs = carousel.getElementsByTagName("div"); 
	numberOfElements = imageDivs.length; 
	
	setInterval('startCarousel()',40);
	
	carousel.addEvent('mousemove', onMouseMove.bindWithEvent( carousel ));
	
});

function onMouseMove( evt ) {
	
	tempX = evt.client.x;
	speed = (tempX - centerX) / 1500;
	
}

function startCarousel(){
	
	for(i=0; i < numberOfElements; i++){
	
		angle = i * ( Math.PI * 2 ) / numberOfElements;
	
		imageDivsStyle = imageDivs[ i ].style; 
		imageDivsStyle.position='absolute'; 
		
		posX = ( Math.sin( count * ( baseSpeed * speed ) + angle )* radiusX + centerX );
		posY = ( Math.cos( count * ( baseSpeed * speed ) + angle )* radiusY + centerY );
		
		
		imageDivsStyle.left = posX+"px"; 
		imageDivsStyle.top = posY+"px"
		
		imageDivWidth = posY/3;
		imageDivZIndex = Math.round(imageDivWidth)+100;
		
		imageDivsStyle.width = imageDivWidth+'px';
		imageDivsStyle.zIndex = imageDivZIndex;
		
		angle += speed;
	
	}
	
	count++
}