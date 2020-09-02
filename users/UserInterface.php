<?php
class UserInterface
{
    public function signup()
    {
        $errors = isset($_GET['message']) ? $_GET['message'] : '';
        if ($errors) {
            $errorMessage = '
            <div style="padding:10px; color:red; background:white;">
                ' . $errors . '
            </div>
            ';
        } else {
            $errorMessage = "";
        }

        return '
        <form action="users/signup.php" class="col s12" method="POST"> 
                ' . $errorMessage . '
            <div class="row">
                <div class="input-field col s6">
                    <input id="full_name" name="full_name" type="text" class="validate">
                    <label for="full_name">Full Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="email" name="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s6">
                    <input id="password2" name="password2" type="password" class="validate">
                    <label for="password2">Repeat Password</label>
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect #311b92 deep-purple darken-4" type="submit" name="signup">
                    Sign Up
                </button>
            </div>
        </form>
        ';
    }


    public function signin()
    {
        $message = isset($_GET['message']) ? $_GET['message'] : '';
        if ($message) {
            $successMessage = '
            <div style="padding:10px; color:green; background:white;">
                ' . $message . '
            </div>
            ';
        } else {
            $successMessage = "";
        }
        return '
        <form action="users/signin.php" class="col s12" method="POST" >
        ' . $successMessage . '
            <div class="row">
                <div class="input-field col s6">
                    <input id="email"  name="email"  type="email" class="validate">
                    <label for="email" >Email</label>
                </div>
                <div class="input-field col s6">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password" >Password</label>
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect #311b92 deep-purple darken-4" type="submit" name="signin">
                    Sign In
                </button>
            </div>
        </form>
        ';
    }

    public function dashboard()
    {
        $message = isset($_GET['message']) ? $_GET['message'] : '';
        if ($message) {
            $successMessage = '
            <div style="color:green;">
                ' . $message . '
            </div>
            ';
        } else {
            $successMessage = "Welcome to dashboard";
        }
        return '
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-5 z-depth-1">
            <div class="row valign-wrapper">
            <div class="col s2">
                <img src="images/yuna.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
            </div>
            <div class="col s10">
                <span class="black-text">
                        ' . $successMessage . '
                </span>
            </div>
            </div>
        </div>
    </div>
        ';
    }
}
