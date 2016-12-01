
/*------------------------------------------------------------------------------------------*/
/*-------------------------------------Script AJAX ajout vaisseau---------------------------*/
/*------------------------------------------------------------------------------------------*/

    $( function() {

        var form
 
        // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      
        // actual = $( "#actual" ),
        // ship_fk = $( "#ship_fk" ),
        // role_fk = $( "#role_fk" ),
        // date_begin = $( "#date_begin" ),
        // // date_end = $( "#date_end" ),
        // user_fk = $( "#user_fk" ),

        // allFields = $( [] ).add( actual ).add( ship_fk ).add( role_fk ).add( date_begin ).add( user_fk ),
        // tips = $( ".validateTips" );

        function isNotEmpty( element ) {

            var str = element.value;

            if( !str || str.length === 0 ) {
                element.setAttribute( 'style', 'border:2px solid red;box-shadow: 0px 0px 20px rgba(255,0,0,1)!important;' );
                // setTimeout("focusElement('" + element.form.name + "', '" + element.name + "')", 0);
                return false;
            } else {
                element.setAttribute( 'style', 'border:2px solid green;box-shadow: 0px 0px 20px rgba(58,132,21,1)!important;' );
                return true;
            }
        }

        // function ActualShipFunction() {

        //     var html= document.getElementById( "date_actual" );
        //     var html2= document.getElementById( "date_no_actual" );

        //     if ( document.getElementById( 'actual' ).checked ) {
        //         html2.style.display = 'none';
        //         html2.className = "";
        //         html2.className = "control-label";
        //     } else {
        //         html.style.display = '';
        //     }  

        // }

        // function checkRegexp( o, regexp, n ) {
        //     if ( !( regexp.test( o.val() ) ) ) {
        //         o.addClass( "ui-state-error" );
        //         updateTips( n );
        //         return false;
        //     } else {
        //         return true;
        //     }
        // }

        //Method traitement formulaire jquery--------------------------------------------------------------------

        function AddActualShip( datas ) {
            
            var valid = true;

            valid = valid && isNotEmpty( document.getElementById("actual") );
            valid = valid && isNotEmpty( document.getElementById("ship_fk") );
            valid = valid && isNotEmpty( document.getElementById("role_fk") );
            valid = valid && isNotEmpty( document.getElementById("date_begin") );
            // valid = valid && isNotEmpty( "date_end" );
            valid = valid && isNotEmpty( document.getElementById("user_fk") );
     
            if ( valid ) {

                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange=function() {

                    var jsonAnswer = JSON.parse( xmlhttp.responseText );

                    if (this.readyState==4 && this.status==200) {
                        document.getElementById( 'actual_ship_div' ).innerHTML = jsonAnswer.html;
                    }

                };

                var formDatas = new FormData( document.querySelector( '#add_actual_ship form' ) ); // L'objet FormData récupère tous les champs du formulaire passé en paramêtre

                xmlhttp.open("POST","c=user&a=addingactualship",true);
                xmlhttp.send(formDatas);

            }

        }

        //fin method-------------------------------------------------------------------------------
     
        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            addActualShip();

        });
     
        $( "btn_actual_ship" ).button().on( "click", function() {
            dialog.dialog( "open" );
        });

    } );
