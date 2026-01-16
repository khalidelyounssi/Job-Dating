<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Job Dating</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-12">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Créer un compte 🚀</h2>
            <p class="text-gray-500 text-sm mt-2">Rejoignez-nous dès maintenant</p>
        </div>

        <form action="/register" method="POST" class="space-y-4">
            
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Nom d'utilisateur</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       id="username" type="text" name="username" placeholder="Votre nom" required>
                <?php if(isset($errors['username'])): ?>
                    <p class="text-red-500 text-xs italic mt-1"><?= $errors['username'][0] ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       id="email" type="email" name="email" placeholder="exemple@email.com" required>
                <?php if(isset($errors['email'])): ?>
                    <p class="text-red-500 text-xs italic mt-1"><?= $errors['email'][0] ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       id="password" type="password" name="password" placeholder="••••••••" required>
                <?php if(isset($errors['password'])): ?>
                    <p class="text-red-500 text-xs italic mt-1"><?= $errors['password'][0] ?></p>
                <?php endif; ?>
            </div>

            <div>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300" 
                        type="submit">
                    S'inscrire
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Déjà un compte ? 
                <a href="/login" class="text-blue-600 hover:text-blue-800 font-semibold">Connectez-vous</a>
            </p>
        </div>

    </div>

</body>
</html>