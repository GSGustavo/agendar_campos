$(document).ready(() => {
	$('.date').mask('00/00/0000');
	$('.time').mask('00:00');
});

colunas = [
	['D', '1', '1', '1', '1', '1'],
	['S', '1', '1', '1', '1', '1'],
	['T', '1', '1', '1', '1', '1'],
	['Q', '1', '1', '1', '1', '1'],
	['Q', '1', '1', '1', '1', '1'],
	['S', '1', '1', '1', '1', '1'],
	['S', '1', '1', '1', '1', '1'],
]

let htmlColunas = ''
let htmlLinhas = ''

$(() => {
	
	for (coluna of colunas) {
		htmlColunas += '<div class="flex flex-col gap-2">'
		for(item of coluna) {
			// biome-ignore lint/suspicious/noGlobalIsNan: <explanation>
			if (!isNaN(item)) {
				htmlLinhas += `<button class="w-10 h-10 rounded-[7px] hover:bg-primary hover:text-white transiton-all duration-150"> ${item} </button> `
			} else {
				htmlLinhas += ` <div class="w-10 h-10 text-gray self-center"> ${item} </div>`
			}
		}
		htmlColunas += htmlLinhas
		htmlLinhas = ''
		htmlColunas += '</div>'
	}

	$("#calendarCols").html(htmlColunas)
	
})


// Get days count of month/year
// const numDays = (y, m) => new Date(y, m, 0).getDate();
// console.log(numDays(2024, 10));

const birthday = new Date('August 19, 1975 23:15:30');
const day1 = birthday.getDay();
// Sunday - Saturday : 0 - 6

console.log(day1);
// Expected output: 2
