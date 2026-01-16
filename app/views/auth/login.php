<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Job Dating</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Bon retour ! 👋</h2>
            <p class="text-gray-500 text-sm mt-2">Connectez-vous pour continuer</p>
        </div>

        <?php if ($msg = \App\Core\Session::getFlash()): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $msg ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors['login'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $errors['login'][0] ?></span>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-4">
            
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       id="email" type="email" name="email" placeholder="exemple@email.com" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       id="password" type="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="flex items-center justify-between">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300" 
                        type="submit">
                    Se connecter
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Pas encore de compte ? 
                <a href="/register" class="text-blue-600 hover:text-blue-800 font-semibold">Inscrivez-vous</a>
            </p>
        </div>

    </div>

</body>
</html>