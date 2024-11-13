<template>
	<nav class="fixed bottom-0 pb-8 flex w-full p-0 mx-auto  justify-center items-center ">
		<div class="hidden text-4xl"></div>
		<ul
			class='flex gap-10 p-2 px-[50px]  border-solid border-[1px] border-black rounded-full bg-white shadow-xl self-center items-center'>
			<Link as="button" href="/agendamentos">

			<li>
				<i class="0 ri-list-check text-3xl hover:font-black cursor-pointer transition-all duration-100 "
					v-bind:class="{ 'text-4xl': agendamentos }"></i>
			</li>
			</Link>

			<Link as="button" href="/menu">
			<li>
				<i class=" 1 ri-home-2-line text-3xl hover:font-black cursor-pointer transition-all duration-100 "
					v-bind:class="{ 'text-4xl': home }"></i>
			</li>
			</Link>
			<Link as="button" href="/profile">
			<li>
				<i class="2 ri-user-line text-3xl hover:font-black cursor-pointer transition-all duration-100 "
					v-bind:class="{ 'text-4xl': profile }"></i>
			</li>
			</Link>

			
		</ul>
	</nav>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {


	// modes
	// 0 = agendamentos
	// 1 = home
	// 2 = profile
	props: {
		'floatbarmode': String
	},

	data(props) {
		return {
			agendamentos: props.floatbarmode === '0' ?? false,
			home: props.floatbarmode === '1' ?? false,
			profile: props.floatbarmode === '2' ?? false,
		}
	},


	setup(props) {
		return { props }
	},

	methods() {

	},
	components: { Link }
}
</script>