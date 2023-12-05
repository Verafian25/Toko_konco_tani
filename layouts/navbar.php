<div class="app-header-inner">  
    <div class="container-fluid py-2">
        <div class="app-header-content"> 
            <div class="row justify-content-between align-items-center">
            <div class="app-search-box col">
                <form class="app-search-form">   
                    <input type="text" placeholder="Search..." name="search" class="form-control search-input">
                    <button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fa-solid fa-magnifying-glass"></i></button> 
                </form>
            </div><!--//app-search-box-->
            <div class="app-utilities col-auto">			            
                <div class="app-utility-item app-user-dropdown dropdown">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']; ?></span>
                    <a class id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img class="img-profile rounded-circle" src="assets/images/undraw_profile.svg"></a>
                    
                </div><!--//app-user-dropdown--> 
            </div><!--//app-utilities-->
        </div><!--//row-->
        </div><!--//app-header-content-->
    </div><!--//container-fluid-->
</div><!--//app-header-inner-->