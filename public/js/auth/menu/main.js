$(document).ready(() => {
	$('.date').mask('00/00/0000');
	$('.time').mask('00:00');
});

const meses = [
	"Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
	"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
];

const dias = [
	['D', 'Domingo'],
	['S', 'Segunda-Feira'],
	['T', 'Terça-Feira'],
	['Q', 'Quarta-Feira'],
	['Q', 'Quinta-Feira'],
	['S', 'Sexta-Feira'],
	['S', 'Sábado']
];


// tipos 
// 0 dia semana
// 1 dia numero

// modos (apenas para tipos 1)
// 0 normal
// 1 bloqueado -> cinza
// 2 indisponivel -> vermelho caso for a reserva de outro usuário
// 3 reservado -> verde caso for a reserva do usuario logado 
// 4 dia de outro mês

modos = {
	0: 'rounded-[7px] hover:border-2 hover:border-primary  transiton-all duration-150',
	1: 'disabled rounded-[7px] bg-gray text-white opacity-25',
	2: 'disabled rounded-[7px] bg-red-500 text-white',
	3: 'disabled rounded-[7px] bg-green text-white',
	4: 'rounded-[7px] hover:border-2 hover:border-gray text-gray transiton-all duration-150',
}

// colunas = [
// 	[
// 		{
// 			'tipo': 0,
// 			'valor': 'D'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 4,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 1,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 2,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 3,
// 			'valor': '1'
// 		},
// 	],
// 	[
// 		{
// 			'tipo': 0,
// 			'valor': 'S'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 	],
// 	[
// 		{
// 			'tipo': 0,
// 			'valor': 'T'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 	],
// 	[
// 		{
// 			'tipo': 0,
// 			'valor': 'Q'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 	],
// 	[
// 		{
// 			'tipo': 0,
// 			'valor': 'Q'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 	],
// 	[
// 		{
// 			'tipo': 0,
// 			'valor': 'S'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 	],
// 	[
// 		{
// 			'tipo': 0,
// 			'valor': 'S'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 0,
// 			'valor': '1'
// 		},
// 		{
// 			'tipo': 1,
// 			'modo': 3,
// 			'valor': '1'
// 		},
// 	],
// ]

let colunas = []

// get current date

let date = new Date();
console.log(`Hoje ${date}`)

let currentDay = date.getDate();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();
console.log(`${currentDay}/${currentMonth + 1}/${currentYear}`)

// Get days count of month/year
const numDays = (y, m) => new Date(y, m, 0).getDate();
let totalDaysMonth = numDays(currentYear, currentMonth + 1)

console.log(`Dias no mês ${totalDaysMonth}`);

// console.log(getWeekDay(currentYear, currentMonth, currentDay))
console.log(`Dia 1: ${dias[getWeekDay(currentYear, currentMonth, currentDay - 1)]}`)

// console.log(getWeekDay(currentYear, currentMonth, totalDaysMonth))
console.log(`Dia ${totalDaysMonth}: ${dias[getWeekDay(currentYear, currentMonth, totalDaysMonth)]}`)

function getWeekDay(year, month, day) {
	const dateWeek = new Date(year, month, day);
	return dateWeek.getDay();
}

for (let coluna = 0; coluna < 7; coluna++) {
	colunas.push([])
	for (let linha = 0; linha < 5; linha++) {
		if (linha === 0) {
			colunas[coluna].push(
				{
					'tipo': 0,
					'valor': dias[coluna][0]
				},
			)
		} else {
			colunas[coluna].push(
				{
					'tipo': 1,
					'modo': 3,
					'valor': '1'
				},
			)
		}

	}

}


let htmlColunas = ''
let htmlLinhas = ''

$(() => {
	for (coluna of colunas) {
		htmlColunas += '<div class="flex flex-col gap-2">'
		for (item of coluna) {

			if (item.tipo === 1) {

				htmlLinhas +=
					`<button class="w-10 h-10 ${modos[item.modo]} ">
						${item.valor}
					</button>`
			} else {
				htmlLinhas +=
					`<div class="flex items-center justify-center w-10 h-10 text-gray self-center">
						${item.valor}
					</div>`
			}
		}
		htmlColunas += htmlLinhas
		htmlLinhas = ''
		htmlColunas += '</div>'
	}
	$("#calendarCols").html(htmlColunas)
})




