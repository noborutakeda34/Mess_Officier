<article role="article">
     <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <header>
                    <h1>Profil de <?php echo $item['Nom'] . ' ' . $item['Prénom'] . ' (' . $item['Login'] . '), ' . $item['Grade'] ; ?></h1>
                    <?php if( $login->getPower()==1 || $login->getPower()==10 ) :?>
                        <div class="liste_choix">| <a href="?c=user" title="">Revenir à la liste</a> | <a href="?c=user&a=update&id= <?php echo $item['ID'] ;?>" title=""> Modifier le profil</a> | <a href="?c=user&a=confirmdelete&id=<?php echo $item['ID'] ;?>" title=""> Supprimer le membre</a> |</div>
                    <?php endif; ?>   
                    <?php
                        if( SRequest::getInstance()->get( '_succ' )!==null ) :
                            echo '<div class="alert alert-success col-sm-offset-3 col-sm-5"><p>La modification a réussie !</p></div>';
                        endif;
                    ?>   
                </header>
            </div>
        </div>

        <br/><br/><br/>

        <div class="row">
            <div class="col-sm-4">
                <img class="img_profil" src="<?php echo $item['Image'] ?>">
            </div>
            <div class="col-sm-offset-1 col-sm-7">
                <p><strong>Nom : </strong><?php echo $item['Nom']?></p>
                <p><strong>Prénom : </strong><?php echo $item['Prénom']?></p>
                <p><strong>Date de naissance : </strong><?php echo $item['Date de naissance']?></p>
                <p><strong>Planète d'origine : </strong><?php echo $item['Planète d\'origine']?><img id="planet_origin" src="<?php echo $item['ImgPlanet'] ?>"></p>
                <?php if ($item['Grade']=='Invité du Club') { ?>
                    <p><strong> - <?php echo $item['Grade'] ;?> - </strong><img class="img_grade" src="<?php echo $item['ImgGrade'] ;?>"></p>
                <?php } else { ;?>
                    <p><strong>Grade : </strong><?php echo $item['Grade'] ;?><img class="img_grade" src="<?php echo $item['ImgGrade'] ;?>"></p>
                <?php } ?>
                <br/><hr/>
                <p><strong>Login : </strong><?php echo $item['Login'] ;?></p>
                <p><strong>Inscrit depuis le : </strong><?php echo $item['Date d\'inscription']?></p>
                <p><strong>Rang de membre : </strong><?php echo $item['Rang']?></p>
                <p><strong>Mail de contact : </strong><?php echo $item['Email'] ;?></p>
                <hr/>      
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h2>Biographie</h2>
                <p><?php echo $item['Description']?></p>
                <?php echo ( $item['Sans affectation']==1 ? '<p><strong>Statut actuel : </strong>non affecté à un vaisseau.</P>' : '' );?> 
                <hr/>
            </div>    
        </div>

        <?php if( $item['Sans affectation']==0 ) :

            /* Divisons affichée en cas de php */

            if ( $this->arr_datas1!==false) : ?>

                <div class="row">
                    <div class="col-sm-12">
                        <h2>Vaisseau actuel</h2>
                        <div class="liste_choix">
                            | <a class="link" href="<?php echo ( SRequest::getInstance()->get( 'c' )!==null ? '?c=' . SRequest::getInstance()->get( 'c' ) . '&' : '?' ); ?>a=updateactualship" title="">Modifier</a> |
                        </div>
                        <div class="col-sm-12" id="actual_ship_div">
                            <div class="row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <h2>Est <?php echo $this->arr_datas1['Statut'] . ' ' . $this->arr_datas1['Classe'] ;?></h2>
                                </div>
                                <div class="col-sm-offset-5 col-sm-6">
                                    <h2> - <?php echo $this->arr_datas1['Nom'] ;?> - </h2>
                                </div>
                                <div class="col-sm-12">
                                    <img id="img_ship" src="<?php echo $this->arr_datas1['ImgVaisseau'] ;?>">
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            | <a class="link" href="c=ship&a=profile&id=<?php echo $this->arr_datas1['ID'] ?>">Voir détails du vaisseau</a> |
                                        </div>
                                        <div class="col-sm-offset-6 col-sm-3">
                                            <em>depuis le <?php echo $this->arr_datas1['Date début'] ?></em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire ajout, affiché si clic sur bouton ajouter -->

                <div id="add_actual_ship" title="Choisir votre vaisseau actuel">
                    <div class="col-sm-12">
                        <p class="validateTips">Tous les champs sont requis.</p>

                        <form class="form-horizontal" action="<?php echo ( SRequest::getInstance()->get( 'c' )!==null ? '?c=' . SRequest::getInstance()->get( 'c' ) . '&' : '?' ); ?>a=addingactualship" data-role="formulaire" method="post">
              
                            <div class="form-group">
                                <div class="col-offset-1 col-xs-5"> 
                                    <div class="col-offset-2 col-xs-6">  
                                        <label class="control-label required" data-role="label" for="actual">Vaisseau actuel</label>
                                        <input disabled type="checkbox" id="actual" name="actual" value="1" class="text ui-widget-content ui-corner-all">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-offset-1 col-xs-5"> 
                                    <label class="control-label required" data-role="label" for="ship_fk">Nom</label>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <select class="selectpicker multiple text ui-widget-content ui-corner-all" id="ship_fk" name="ship_fk" onBlur="isNotEmpty(this)">
                                                <?php
                                                foreach( $this->arr_datas2 as $item ) :
                                                    echo '<option value="' . $item['ID'] . '">'  . $item['Class'] . ' -' . $item['Label'] . '- </option>';
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-xs-offset-1 col-xs-2">   
                                    <label class="control-label" for="role_fk">Rôle à bord</label>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <select class="selectpicker multiple text ui-widget-content ui-corner-all" id="role_fk" name="role_fk" onBlur="isNotEmpty(this)">
                                                <?php
                                                foreach( $this->arr_datas5 as $item ) :
                                                    echo '<option value="' . $item['ID'] . '">' . $item['Label'] . '</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- vaisseau actuel par defaut -->
                            <div class="form-group" id="date_actual">    
                                <div class="col-xs-offset-1 col-xs-2">
                                    <label class="control-label required" data-role="label" for="date_begin">Depuis le </label>
                                    <input class="form-control" id="date_begin" name="date_begin" type="date" value="" class="text ui-widget-content ui-corner-all"/>
                                </div>
                            </div>
                            <!-- Si pas vaisseau actuel -->
                            <!-- <div class="form-group" id="date_no_actual">  
                                <div class="col-xs-offset-1 col-xs-2">
                                    <label class="control-label required" data-role="label" for="date_begin">Du </label>
                                    <input class="form-control" id="date_begin" name="date_begin" type="date" value=""/>
                                </div>
                                <div class="col-xs-offset-1 col-xs-2">
                                    <label class="control-label required" data-role="label" for="date_end">Au </label>
                                    <input class="form-control" id="date_end" name="date_end" type="date" value=""/>
                                </div>
                            </div> -->
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-offset-5 col-xs-3"> 
                                        <input type="hidden" name="user_fk" value="<?php echo $this->userselect['ID']?>"></input>
                                        <input data-role="submit" type="submit" value="Ajouter" tabindex="-1" style="position:absolute; top:-1000px"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Divisons affichée en cas d'ajax -->

                <div class="row ui-widget" id="actual_ship_div">
                </div>

            <?php else : ?>

                <div class="row">
                    <div class="col-sm-12">
                        <h2>Pas de vaisseau actuel renseigné pour l'instant.</h2>
                        <div class="liste_choix">
                            | <button id="btn_actual_ship">Ajouter</button> |
                        </div>
                    </div>
                </div>

            <?php endif; 

        endif;
        // var_dump($this->arr_datas2);
        if ( !empty( $this->arr_datas2 ) ) :?>

            <div class="row">
                <div class="col-sm-12">
                    <h2>Historique des vaisseaux</h2>
                    <div class="col-sm-offset-1 col-sm-10" id="list_ship_div">
                        <div class="container">
                            <div class="row">
                            
                            <?php foreach( $this->arr_datas2 as $item ) : ?>
                                <!-- fiche vaisseau -->
                                <div class="col-sm-3" id="ship_div">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img id="icone_ship" src="<?php echo $item['ImgVaisseau'] ?>">
                                            </div>   
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3>Etait <?php echo $item['Statut'] ?> <?php echo $item['Classe'] ?></h3>
                                                <h3> - <em><?php echo $item['Nom'] ?></em> - </h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p>Du <?php echo $item['Date début'] ?> au <?php echo $item['Date fin'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                | <a class="link" href="c=ship&a=profile&id=<?php echo $item['ID'] ?>">Voir détails du vaisseau</a> |
                                            </div>
                                        </div> 
                                    </div>   
                                </div>
                               <!--  fin fiche vaisseau -->
                            <?php endforeach; ?>
                        
                            </div>
                        </div>   
                    </div>
                </div>
            </div>

        <?php else : ?>

            <div class="row">
                <div class="col-sm-12">
                    <h2>Pas d'historique des vaisseaux pour l'instant.</h2>
                    <div class="liste_choix">
                        | <a class="link" href="<?php echo ( SRequest::getInstance()->get( 'c' )!==null ? '?c=' . SRequest::getInstance()->get( 'c' ) . '&' : '?' ); ?>a=addship" title="">Ajouter</a> |
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>

   <!--  Script ajax -->
    <script type="text/javascript" src="./assets/js/ajax.js"></script>

    <script type="text/javascript">
    //<![CDATA[

        //-------------vérif champ non vide---------------//

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

        //-----------------verif condition vaissau actuel  cochée----------------//

        // function isActualShipFunction() {

        //     var html= document.getElementById( "actual_div" );
        //     var html2= document.getElementById( "no_actual_div" );

        //     if ( document.getElementById( 'actual' ).checked ) {
        //         html.style.display = 'none';
        //         html2.className = "";
        //         html2.className = "control-label";
        //     } else {
        //         html.style.display = '';
        //     }  

        // }

    //]]>
    </script>
</article>
