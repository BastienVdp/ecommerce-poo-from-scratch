<div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
		Inscription
	</h2>
</div>
<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="/register" method="POST">
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                Adresse email
            </label>
            <div class="mt-2">
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    autocomplete="email"  
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                <?= isset($errors['email'])
                    ? '<p class="text-red-500 text-xs italic">' . $errors['email'] . '</p>' 
                    : '' 
                ?>
            </div>
        </div>
        <div>
            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">
                Nom d'utilisateur
            </label>
            <div class="mt-2">
                <input 
                    id="username" 
                    name="username" 
                    type="text" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                <?= isset($errors['username'])
                    ? '<p class="text-red-500 text-xs italic">' . $errors['username'] . '</p>' 
                    : '' 
                ?>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                    Mot de passe
                </label>
            </div>
            <div class="mt-2">
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    autocomplete="current-password" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                <?= isset($errors['password'])
                    ? '<p class="text-red-500 text-xs italic">' . $errors['password'] . '</p>' 
                    : '' 
                ?>
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between">
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                    Confirmation du mot de passe
                </label>
            </div>
            <div class="mt-2">
                <input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                <?= isset($errors['password_confirmation'])
                    ? '<p class="text-red-500 text-xs italic">' . $errors['password_confirmation'] . '</p>' 
                    : '' 
                ?>
            </div>
        </div>
        <div>
            <button 
                type="submit" 
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                S'enregistrer
            </button>
        </div>
    </form>
    <p class="mt-10 text-center text-sm text-gray-500">
        Déjà inscrit ? 
        <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
            Se connecter
        </a>
    </p>
  </div>