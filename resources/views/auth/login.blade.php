<x-guest-layout>

   {{-- <div class="wrapper">
        <div class="login-text">
            <button class="cta"><i class="fas fa-chevron-down fa-1x"></i></button>
            <div class="text">
                <a href="">Login</a>
                <hr>
                <br>
                <input type="text" placeholder="Username">
                <br>
                <input type="password" placeholder="Password">
                <br>
                <button class="login-btn">Log In</button>
                <button class="signup-btn">Sign Up</button>
            </div>
        </div>
        <div class="call-text">
            <h1>Show us your <span>creative</span> side</h1>
            <button>Join the Community</button>
        </div>

    </div>--}}

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

  {{--  body {
    font-family: 'Raleway', sans-serif;
    background-color: #e7e7e7;
    }
    .wrapper {
    width: 800px;
    height: 600px;
    position: relative;
    margin: 3% auto;
    box-shadow: 2px 18px 70px 0px #9D9D9D;
    overflow: hidden;
    }

    .login-text {
    width: 800px;
    height:450px;
    background: linear-gradient(to left, #ab68ca, #de67a3);
    position: absolute;
    top: -300px;
    box-sizing: border-box;
    padding: 6%;
    transition: all 0.5s ease-in-out;
    z-index: 11;
    }

    .text {
    margin-left: 20px;
    color: #fff;
    display: none;
    transition: all 0.5s ease-in-out;
    transition-delay: 0.3s;

    a, a:visited {
    font-size: 36px;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    display: block;
    }

    hr {
    width: 10%;
    float: left;
    background-color: #fff;
    font-size: 16px;
    }

    input {
    margin-top: 30px;
    height: 40px;
    width: 300px;
    border-radius: 2px;
    border: none;
    background-color: #444;
    opacity: 0.6;
    outline: none;
    color: #fff;
    padding-left: 10px;
    }

    input[type=text] {
    margin-top: 60px;
    }

    button {
    margin-top: 60px;
    height: 40px;
    width: 140px;
    outline: none;
    }

    .login-btn {
    background: #fff;
    border: none;
    border-radius: 2px;
    color: #696a86;
    }

    .signup-btn {
    background: transparent;
    border: 2px solid #fff;;
    border-radius: 2px;
    color: #fff;
    margin-left: 30px;
    }
    }

    .cta {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #696a86;
    border: 2px solid #fff;
    position: absolute;
    bottom: -30px;
    left: 370px;
    color: #fff;
    outline: none;
    cursor: pointer;
    z-index: 11;
    }

    .call-text {
    background-color: #fff;
    width: 800px;
    height: 450px;
    position: absolute;
    bottom: 0;
    padding: 10%;
    box-sizing: border-box;
    text-align: center;

    h1 {
    font-size: 42px;
    margin-top: 10%;
    color: #696a86;

    span {
    color: #333;
    font-weight: bolder;

    }
    }

    button {
    height: 40px;
    width: 180px;
    border: none;
    border-radius: 20px;
    background: linear-gradient(to left, #ab68ca, #de67a3);
    color: #fff;
    font-weight: bolder;
    margin-top: 30px;
    cursor: pointer;
    outline: none;
    }
    }

    .show-hide {
    display: block;
    }

    .expand {
    transform: translateY(300px);
    }--}}

</x-guest-layout>

{{--var cta = document.querySelector(".cta");
var check = 0;

cta.addEventListener('click', function(e){
var text = e.target.nextElementSibling;
var loginText = e.target.parentElement;
text.classList.toggle('show-hide');
loginText.classList.toggle('expand');
if(check == 0)
{
cta.innerHTML = "<i class=\"fas fa-chevron-up\"></i>";
check++;
}
else
{
cta.innerHTML = "<i class=\"fas fa-chevron-down\"></i>";
check = 0;
}
})--}}
