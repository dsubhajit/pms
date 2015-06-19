
<section class="content-header" >    
    <h1 class="page-header text-info">List of Companies</h1>    
</section>
<section class="content-element" >
    <div class="panel panel-default" >
        <div class="panel-heading" >
            Company List
        </div>
        <table class="table table-bordered table-hovered" >
            <tr class="active" >
                <td>Company Name</td>
                <td>Website</td>
                <td>Contact Name</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Options</td>
            </tr>
            <?php
                require_once 'class/class.company_login.php';
                require_once 'class/class.company_profile.php';

                $cmp = company_login::getAllCompany_login();
                foreach ($cmp as $cp){
                    $c= new company_profile();
                    $c->findOnProfile_id($cp->getProfile_id());
            ?>
            <tr>
                <td><?=$c->getCompany_name() ?></td>
                <td><?=$c->getCompany_website() ?></td>
                <td><?=$c->getCp_name() ?></td>
                <td><?=$c->getCp_phone() ?></td>
                <td><?=$c->getCp_email() ?></td>
                <td>
                    <a href="?page_id=6&cmp_id=<?=$cp->getCmp_id() ?>" class="btn btn-primary btn-xs" title="View Details"  ><span class="glyphicon glyphicon-check"></span></a>                    
                </td>
            </tr> 
            <?php
                }
            ?>

        </table>
    </div>
</section>

