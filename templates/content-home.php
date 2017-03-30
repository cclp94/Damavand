<?php
    // Get projects and their creators
    $projects = null;
?>

<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active ">
                <a href="#project-list" aria-controls="project-list" role="tab" data-toggle="tab">Projects</a>
            </li>
            <?php if($user->permission){?>
                <li role="presentation">
                    <a href="#project-add" aria-controls="project-add" role="tab" data-toggle="tab">Add Project</a>
                </li>
            <?php }?>
        </ul>
    </div>
    <div class="col-md-3">
    <!-- Number of projects -->
        <div class="n-Projects">
            <span class="n-projects-number"><?php echo count($projects); ?></span>
            <strong>Project<?php if(count($projects) == 1)
                                     echo '';
                                  else
                                     echo 's'; ?>
             </strong>
        </div>
    <!-- total costs with projects -->
    </div>
    <!-- Tab panes -->
    <div class="tab-content col-md-9">
        <div role="tabpanel" class="tab-pane fade in active" id="project-list">
            <?php
                if(isset($projects)){
                    showProjectPreviews();
                }elseif($user->permission){
                    echo '<a class="add-project" href="#">Add your first project!</a>';
                }else{
                    echo '<strong>You don\'t have any projects yet</strong>';
                }
            ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="project-add">
            <form method="post" action="./app/register.php">
                <div class="form-group">
                    <label for="projectName" class="col-sm-2 control-label text-center">Project Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="projectName" placeholder="Project Name" required/></br>
                    </div>
                </div>
            <div class="form-group">
                    <label for="username" class="col-sm-2 control-label text-center">Username</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="username" placeholder="User" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="password" class="col-sm-2 control-label text-center">Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" placeholder="Password" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="passwordConfirm" class="col-sm-2 control-label text-center">Confirm Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="passwordConfirm" placeholder="Confirm Password" required/></br>
                    </div>
            </div>
            <div class="form-group">
                    <label for="email" class="col-sm-2 control-label text-center">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" placeholder="Email" required/></br>
                    </div>
            </div>
                <input  class="btn btn-primary btn-lg center-block" type="submit" value="Register"/>
            </form>
        </div>
    </div>
</div>

<?php

function showProjectPreviews(){
    foreach($projects as $project){
        echo '<div class="project"><a href="./project.php?id='.$project->id;
        echo '<h1 class="project-title">'.$project->title.'</h1>';
        echo '<span class="project-creator>'.$project->creator.'</span>';
        echo '</a></div>';
    }
}

?>