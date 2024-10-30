/*
###############################################################################################################
#	@Daweed																									
#	Mise a jour: 07/09/2007																					
#	www.daweed.info																							
#
#
#	::	SWFintegrator	::																	
#
#
#	Testé sous:
#	-FireFox
#	-IE7
#
#
#	@ PARAM @
#	iMinWidth			:	largeur minimum
#	iMinHeight			:	hauteur minimum
#	sCssType			:	"fullscreen" ou "center"
#	sFlashContenaire	:	nom de la div contenant le swf
#
###############################################################################################################
*/


/*
DO NOT EDIT BELOW THAT POINT
*/


function SWFintegrator(iMinWidth,iMinHeight,sCssType,sFlashContenaire){
		
		//passer les parametres a la fonction constructeur
		this.init(iMinWidth,iMinHeight,sCssType,sFlashContenaire);
		
};

m_SWFintegrator = SWFintegrator.prototype={	

	//initialisation de la classe.
	init:function(iMinWidth,iMinHeight,sCssType,sFlashContenaire){
		
		m_SWFintegrator.iMinWidth	=	iMinWidth;
		m_SWFintegrator.iMinHeight	=	iMinHeight;
		m_SWFintegrator.sCssType	=	sCssType;
		
		m_SWFintegrator.oFlashContent	=	document.getElementById(m_SWFintegrator.setDivContainer(sFlashContenaire))
		m_SWFintegrator.oBody = document.getElementsByTagName("body")[0];
		m_SWFintegrator.oHtml = document.getElementsByTagName("html")[0];
		
		//gestionnaire d'evenement
		m_SWFintegrator.addEvent(window, "load", m_SWFintegrator.FireOnLoad,false)		
		m_SWFintegrator.addEvent(window, "resize", m_SWFintegrator.FireOnResize,false)
		
	},
	
	//les fonctions qui se lancent au chargement
	FireOnLoad:function(){				
			m_SWFintegrator.initCss();
			m_SWFintegrator.getScreenSize();			
			m_SWFintegrator.setScroll();	
			m_SWFintegrator.setDynamiqueCSS(m_SWFintegrator,m_SWFintegrator.sCssType);				
	},
	

	//les fonctions qui se lancent au resize
	FireOnResize:function(){	
		m_SWFintegrator.getScreenSize();	
		m_SWFintegrator.setScroll();
		m_SWFintegrator.setDynamiqueCSS();	
	},

	//initialiser le css de base
	initCss:function(){		
		m_SWFintegrator.oBody.style.margin=0;			
		m_SWFintegrator.oBody.style.padding=0;
		m_SWFintegrator.oBody.style.border=0;	
		m_SWFintegrator.oHtml.style.margin=0;
		m_SWFintegrator.oHtml.style.padding=0;
		m_SWFintegrator.oHtml.style.border=0;			
		m_SWFintegrator.oFlashContent.style.margin=0;		
		m_SWFintegrator.oFlashContent.style.padding=0;
		m_SWFintegrator.oFlashContent.style.border=0;	
			
	},
	
	//récupere la résolution de l'écran
	getScreenSize:function(){
					
		if (window.innerWidth){				
	     	m_SWFintegrator.iScreenWidth = window.innerWidth;
	        m_SWFintegrator.iScreenHeight = window.innerHeight;
	    }
	    else if (document.all){	    		
	    	m_SWFintegrator.iScreenWidth = document.body.clientWidth;
	    	m_SWFintegrator.iScreenHeight = document.body.clientHeight;
		}
		
	},
	
	
	//gestion de la scroll sous IE
	setScroll:function(){
				
		if(m_SWFintegrator.iScreenWidth<m_SWFintegrator.iMinWidth || m_SWFintegrator.iScreenHeight<m_SWFintegrator.iMinHeight){	
			m_SWFintegrator.oBody.setAttribute("scroll","yes");	
		}else{	
			m_SWFintegrator.oBody.setAttribute("scroll","no");	
		}		
	},
	
	
	//Retourne le nom de la div contenaire du flash
	setDivContainer:function(DivContainer){
		
		if(DivContainer){
			return DivContainer;
		}else{
			// valeur par defait du swfObject
			return "flashcontent";
		}
	},
	
		
	setDynamiqueCSS:function(){
		
		//Case : center	
		if(m_SWFintegrator.sCssType=="center"){
		
			m_SWFintegrator.oBody.setAttribute("overflow","auto");
			m_SWFintegrator.oFlashContent.style.position="absolute"
			m_SWFintegrator.oFlashContent.style.width=m_SWFintegrator.iMinWidth+"px"
			m_SWFintegrator.oFlashContent.style.height=m_SWFintegrator.iMinHeight+"px"
			m_SWFintegrator.iMarginLeft=-m_SWFintegrator.iMinWidth/2;
			m_SWFintegrator.iMarginTop=-m_SWFintegrator.iMinHeight/2;		
			
			
			//gestion de la position horizontale
			if(m_SWFintegrator.iScreenWidth<m_SWFintegrator.iMinWidth)
			{			
				m_SWFintegrator.oFlashContent.style.left="0%"		
				m_SWFintegrator.oFlashContent.style.marginLeft="0";	
			}else
			{
				m_SWFintegrator.oFlashContent.style.left="50%";
				m_SWFintegrator.oFlashContent.style.marginLeft=m_SWFintegrator.iMarginLeft+"px";
			}
			
			
			//gestion de la position  verticale
			if(m_SWFintegrator.iScreenHeight<m_SWFintegrator.iMinHeight)		
			{
				m_SWFintegrator.oFlashContent.style.top="0%"
				m_SWFintegrator.oFlashContent.style.marginTop="0";
			}else
			{		
				m_SWFintegrator.oFlashContent.style.top="50%";
				m_SWFintegrator.oFlashContent.style.marginTop=m_SWFintegrator.iMarginTop+"px";				
			}			
		}
		
		
		//Case FullScreen 
		if(m_SWFintegrator.sCssType=="fullscreen"){	
		
			m_SWFintegrator.oBody.setAttribute("overflow","auto");
			
			//on gere la largeur		
			if (m_SWFintegrator.iScreenWidth<m_SWFintegrator.iMinWidth)	
			{				
				m_SWFintegrator.oFlashContent.style.width=m_SWFintegrator.iMinWidth+"px"					
			}
			else if (m_SWFintegrator.iScreenWidth>m_SWFintegrator.iMinWidth)
			{					
				m_SWFintegrator.oFlashContent.style.width="100%"	
			}
					
			//on gere la hauteur				
			if(m_SWFintegrator.iScreenHeight<m_SWFintegrator.iMinHeight)
			{							
					m_SWFintegrator.oFlashContent.style.height=m_SWFintegrator.iMinHeight+"px"	
			}
			else if(m_SWFintegrator.iScreenHeight>m_SWFintegrator.iMinHeight)
			{						
				m_SWFintegrator.oFlashContent.style.height="100%"	
			}
		}
		
		m_SWFintegrator.oFlashContent.style.display="block";
	},
	
	
	//gestionnaire d'evenement de l'objet
	addEvent: function(element, eventType, doFunction, useCapture){	
			
		if (element.addEventListener) {		
			element.addEventListener(eventType, doFunction, useCapture);
			return true;	
					
		} else if (element.attachEvent) {		
			var r = element.attachEvent('on' + eventType, doFunction);
			return r;
						
		} else {		
			element['on' + eventType] = doFunction;				
		}		
	}
	
	
}
