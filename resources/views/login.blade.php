<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <section class="min-h-screen  flex box-border justify-center items-center">
        <div class="bg-gray-100 bg-opacity-90 backdrop-filter backdrop-blur-lg shadow-md rounded-2xl flex max-w-3xl p-5 items-center">
            <div class="md:w-1/2 px-8">
                <h2 class="font-bold text-3xl text-[#002D74]">Login</h2>
                <p class="text-sm mt-4 text-[#002D74]">If you already a member, easily log in now.</p>
    
                <form action="" class="flex flex-col gap-4">
                    <input class="p-2 mt-8 rounded-xl border" type="email" name="email" placeholder="Email">
                    <div class="relative">
                        <input class="p-2 rounded-xl border w-full" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                    <button class="bg-[#002D74] text-white py-2 rounded-xl hover:scale-105 duration-300 hover:bg-[#206ab1] font-medium" type="submit">Login</button>
                    
                </form>
                
            </div>
            <div class="md:block hidden w-1/2">
                <img class="rounded-2xl max-h-[1600px]" src="https://images.unsplash.com/photo-1552010099-5dc86fcfaa38?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxmcmVzaHxlbnwwfDF8fHwxNzEyMTU4MDk0fDA&ixlib=rb-4.0.3&q=80&w=1080" alt="login form image">
            </div>
        </div>
    </section>
</body>
</html>