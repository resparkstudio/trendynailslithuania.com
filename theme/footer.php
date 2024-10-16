<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @package _tw
 */

?>

<footer id="site-footer" class="bg-black text-white py-8">
	<div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
		<!-- Left Section: Company Info -->
		<div>
			<h2 class="text-xl font-bold mb-2">TRENDY nails</h2>
			<p class="text-sm">
				Trendy Nails yra šiuolaikiškas ir inovatyvus Ukrainos manikiūro priemonių prekes ženklas, orientuotas į
				kokybiškų produktų tiekimą nagų industrijai.
			</p>
			<ul class="mt-4 space-y-2">
				<li>+370 000 00000</li>
				<li><a href="mailto:info@trendynailsthluania.com" class="underline">info@trendynailsthluania.com</a>
				</li>
			</ul>
			<div class="flex space-x-4 mt-4">
				<a href="#"><img src="facebook-icon-path" alt="Facebook" class="w-6 h-6"></a>
				<a href="#"><img src="instagram-icon-path" alt="Instagram" class="w-6 h-6"></a>
			</div>
		</div>

		<!-- Store Links -->
		<div>
			<h2 class="text-xl font-bold mb-2">PARDUOTUVĖ</h2>
			<ul class="space-y-2">
				<li><a href="#" class="hover:underline">Geliniai lakai</a></li>
				<li><a href="#" class="hover:underline">Bazės ir topai</a></li>
				<li><a href="#" class="hover:underline">UV gelio sistema</a></li>
				<li><a href="#" class="hover:underline">Polygelio sistema</a></li>
				<li><a href="#" class="hover:underline">Darbo įrankiai</a></li>
				<li><a href="#" class="hover:underline">Rinkiniai</a></li>
			</ul>
		</div>

		<!-- Info Links -->
		<div>
			<h2 class="text-xl font-bold mb-2">INFO</h2>
			<ul class="space-y-2">
				<li><a href="#" class="hover:underline">Apie mus</a></li>
				<li><a href="#" class="hover:underline">Blogas</a></li>
				<li><a href="#" class="hover:underline">Kontaktai</a></li>
				<li><a href="#" class="hover:underline">Privatumo politika</a></li>
				<li><a href="#" class="hover:underline">Slapukai</a></li>
			</ul>
		</div>

		<!-- Newsletter & Payment Options -->
		<div>
			<h2 class="text-xl font-bold mb-2">PRENUMERUOKITE</h2>
			<p class="text-sm">
				Užsiregistruokite ir gaukite –15 % nuolaidą pirmajam užsakymui, pirmieji sužinokite apie naujausius
				produktus!
			</p>
			<form action="#" method="POST" class="mt-4">
				<input type="email" name="email" placeholder="El. paštas"
					class="w-full p-2 bg-gray-700 text-white rounded">
				<button type="submit" class="w-full mt-2 bg-white text-black py-2 px-4 rounded">Prenumeruoti</button>
			</form>
			<div class="flex space-x-4 mt-4">
				<img src="visa-icon-path" alt="Visa" class="w-8 h-8">
				<img src="paypal-icon-path" alt="PayPal" class="w-8 h-8">
				<img src="google-pay-icon-path" alt="Google Pay" class="w-8 h-8">
				<img src="apple-pay-icon-path" alt="Apple Pay" class="w-8 h-8">
			</div>
		</div>
	</div>
	<div class="container mx-auto px-4 mt-8 text-center">
		<p class="text-sm">&copy; 2024. Trendy Nails Lithuania</p>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>