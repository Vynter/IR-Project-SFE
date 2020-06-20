<?php
session_start();
include('db.php');
if (!isset($_SESSION['id'])){
    header('location: index.php');
    //('Location: Dashboard.php');
}
    //echo $_SESSION['id'];

//require('entete.php');
include_once('header.php');



?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <br />

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#stat1" class="nav-link active show" role="tab" data-toggle="tab">Liste des titres des Projets de fin d'étude par
                stagiaire de chaque promotion</a>
        </li>

        <li class="nav-item">
            <a href="#stat3" class="nav-link" role="tab" data-toggle="tab">Etat de validation des Sujets de Projets de fin d'étude</a>
        </li>

        <li class="nav-item">
            <a href="#stat2" class="nav-link" role="tab" data-toggle="tab">Liste des sujets disponible promosés par des entreprises</a>
        </li>
        <li class="nav-item">
            <a href="#stat4" class="nav-link" role="tab" data-toggle="tab">Liste des procès verbaux des soutenances</a>
        </li>
        <li class="nav-item">
            <a href="#stat5" class="nav-link" role="tab" data-toggle="tab">Liste des membres de commissions de jury</a>
        </li>
        <li class="nav-item">
            <a href="#stat6" class="nav-link" role="tab" data-toggle="tab">Etat d'avancement des projets de fin d'étude</a>
        </li>
    </ul>

    <div class="tab-content" style="padding-top: 50px;margin:0 about;">
        <div role="tabpanel" class="tab-pane fade in active show " id="stat1">




            <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Liste des titres des PFE
                par stagiaire de chaque promotion</h3>
            <table class="table" style="margin-bottom:30px;">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre PFE</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Promotion</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $ENT=$cn->prepare("select intsujet,prenom,nom,promo from personne p , stagiaire s, sujet st
                                        where p.idpersonne=s.idpersonne and s.mat=st.mat
                                        order by promo desc");
                    $ENT->execute();
                    $nb=1;
                    while ($data = $ENT->fetch()){


                        echo '<tr>
                                <th scope="row">'.$nb.'</th>
                                <td>'.$data['INTSUJET'].'</td>
                                <td>'.$data['PRENOM'].'</td>
                                <td>'.$data['NOM'].'</td>
                                <td>'.$data['PROMO'].'</td>
                            </tr>';
                        $nb++;
                    }
                          ?>

                </tbody>
            </table>




        </div>
        <div role="tabpanel" class="tab-pane fade" id="stat2">


                   <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Liste des sujets disponible proposés par des entreprises</h3>
                        <table class="table" style="margin-bottom:30px;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Identifiant Sujet</th>
                                    <th scope="col">Intitulé de Sujet</th>
                                    <th scope="col">Identifiant Entreprise</th>
                                    <th scope="col">Nom de l'Entreprise</th>
                                    <th scope="col">Date de dépôt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                                
                                            $ENT=$cn->prepare("select s.idsujet,intsujet,e.ident,RS,dated
                                            from sujet s,entreprise e  
                                            where MAT is null and e.ident=s.ident
                                            order by dated desc

                                            ");
                                            $ENT->execute();
                                            $nb=1;
                                            while ($data = $ENT->fetch()){


                                                echo '<tr>
                                                        <th scope="row">'.$nb.'</th>
                                                        <td>'.$data['IDSUJET'].'</td>
                                                        <td>'.$data['INTSUJET'].'</td>
                                                        <td>'.$data['IDENT'].'</td>
                                                        <td>'.$data['RS'].'</td>
                                                        <td>'.$data['DATED'].'</td>
                                                    </tr>';
                                                $nb++;
                                            }
                                                  ?>

                            </tbody>
                        </table>





        </div>
        <div role="tabpanel" class="tab-pane fade" id="stat3">
            
              <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Etat de validation des Sujets de PFE</h3>
                        <table class="table" style="margin-bottom:30px;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Identifiant du Décision</th>
                                    <th scope="col">Identifiant du Sujet</th>
                                    <th scope="col">Intitulé du Sujet</th>
                                    <th scope="col">Décision</th>
                                    <th scope="col">Motif</th>
                                    <th scope="col">Date décision</th>
                                    <th scope="col">ID Commission spécialisée</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                


                                                
                                            $ENT=$cn->prepare("select IDDECISION,D.IDSUJET,INTSUJET,DECISION,MOTIF,DATEDC,IDCOMMISSIONS from DecisiondEvaluation d, sujet s where decision <>'standby' and s.idsujet=d.idsujet ORDER BY decision desc,iddecision

                                            ");
                                            $ENT->execute();
                                            $nb=1;
                                            while ($data = $ENT->fetch()){

                                                
                                                echo '<tr>
                                                        <th scope="row">'.$nb.'</th>
                                                        <td>'.$data['IDDECISION'].'</td>
                                                        <td>'.$data['IDSUJET'].'</td>
                                                        <td>'.$data['INTSUJET'].'</td>
                                                        <td>'.$data['DECISION'].'</td>
                                                        <td>'.$data['MOTIF'].'</td>
                                                        <td>'.$data['DATEDC'].'</td>
                                                        <td>'.$data['IDCOMMISSIONS'].'</td>
                                                        
                                                    </tr>';
                                                $nb++;
                                            }
                                                  ?>

                            </tbody>
                        </table>

        </div>
        
                <div role="tabpanel" class="tab-pane fade" id="stat4">
            
              <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Liste des procès verbaux des soutenances</h3>
                        <table class="table" style="margin-bottom:30px;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Procès verbal</th>
                                    <th scope="col">Code Soutenance</th>
                                    <th scope="col">Matricul</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Intitulé du Sujet</th>
                                    <th scope="col">Note présentation</th>
                                    <th scope="col">Note rapport</th>
                                    <th scope="col">Note final</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                


                                                
                                            $ENT=$cn->prepare("select p.idpv,sn.codest,sg.mat,pr.nom,pr.prenom,s.intsujet,p.notepr,p.noter,a.final
                                            from pv p,(
                                            select idpv, NotePr,NoteR,((NoteR+NotePr)/2)as final ,Djury from pv) a
                                            ,soutenance sn, pfe pf,stage st,sujet s,stagiaire sg, personne pr
                                            where  a.idpv=p.idpv and p.codest=sn.codest and sn.codepfe= pf.codepfe and pf.numconv=st.numconv 
                                            and st.idsujet=s.idsujet and s.mat=sg.mat and sg.idpersonne= pr.idpersonne");
                                            $ENT->execute();
                                            $nb=1;
                                            while ($data = $ENT->fetch()){

                                                
                                                echo '<tr>
                                                        <th scope="row">'.$nb.'</th>
                                                        <td>'.$data['IDPV'].'</td>
                                                        <td>'.$data['CODEST'].'</td>
                                                        <td>'.$data['MAT'].'</td>
                                                        <td>'.$data['NOM'].'</td>
                                                        <td>'.$data['PRENOM'].'</td>
                                                        <td>'.$data['INTSUJET'].'</td>
                                                        <td>'.$data['NOTEPR'].'</td>
                                                        <td>'.$data['NOTER'].'</td>
                                                        <td>'.$data['FINAL'].'</td>
                                                    </tr>';
                                                $nb++;
                                            }
                                                  ?>

                            </tbody>
                        </table>


    

        </div>
        
        
        
<div role="tabpanel" class="tab-pane fade" id="stat5">
            
              <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Liste des membres de commissions de jury</h3>
                        <table class="table" style="margin-bottom:30px;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Code Jury</th>
                                    <th scope="col">Code enseignant</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                


                                                
                                            $ENT=$cn->prepare(" select c.codej,e.codeens,nom,prenom from composer c,jury j,personne p,enseignant e where j.codej=c.codej and e.codeens=c.codeens and e.idpersonne=p.idpersonne order by codej");
                                            $ENT->execute();
                                            $nb=1;
                                            while ($data = $ENT->fetch()){

                                                
                                                echo '<tr>
                                                        <th scope="row">'.$nb.'</th>
                                                        <td>'.$data['CODEJ'].'</td>
                                                        <td>'.$data['CODEENS'].'</td>
                                                        <td>'.$data['NOM'].'</td>
                                                        <td>'.$data['PRENOM'].'</td>

                                                    </tr>';
                                                $nb++;
                                            }
                                                  ?>

                            </tbody>
                        </table>


    

        </div>
        <div role="tabpanel" class="tab-pane fade" id="stat6">
            

              <h3  style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Etat d'avancement des projets de fin d'étude</h3>
                        <table class="table" style="margin-bottom:30px;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Etat d'avancement</th>
                                    <th scope="col">Code Commission</th>
                                    <th scope="col">Identifiant de sujet</th>
                                    <th scope="col">Intitulé de sujet</th>
                                    <th scope="col">Observation</th>
                                    <th scope="col">Date de l'état d'avancement</th>
                                    <th scope="col">Matricule </th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Cycle</th>
                                    <th scope="col">Promotion</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        
  
                                            $ENT=$cn->prepare(" select t.idea,codec,sj.idsujet,sj.intsujet,obs,dateea,s.mat,p.nom,p.prenom,codecycle,promo 
 from etatdavancement t,pfe pf,stage sg,sujet sj, stagiaire s, personne p where t.codepfe=pf.codepfe and pf.numconv=sg.numconv and sg.idsujet= sj.idsujet and sj.mat=s.mat and s.idpersonne=p.idpersonne order by dateea desc");
                                            $ENT->execute();
                                            $nb=1;
                                            while ($data = $ENT->fetch()){

                                                
                                                echo '<tr>
                                                        <th scope="row">'.$nb.'</th>
                                                        <td>'.$data['IDEA'].'</td>
                                                        <td>'.$data['CODEC'].'</td>
                                                        <td>'.$data['IDSUJET'].'</td>
                                                        <td>'.$data['INTSUJET'].'</td>
                                                        <td>'.$data['OBS'].'</td>
                                                        <td>'.$data['DATEEA'].'</td>
                                                        <td>'.$data['MAT'].'</td>
                                                        <td>'.$data['NOM'].'</td>
                                                        <td>'.$data['PRENOM'].'</td>
                                                        <td>'.$data['CODECYCLE'].'</td>
                                                        <td>'.$data['PROMO'].'</td>

                                                    </tr>';
                                                $nb++;
                                            }
                                                  ?>

                            </tbody>
                        </table>


    

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>

<!--<img src="stat/Stat6_admi2.php">-->
<?php
include_once('footer.php');
        
        ?>