#include <iostream>
#include <string>
#include <string.h>
# include <iomanip>
#include <fstream>
#include <conio.h>
//#include "windows.h"
#include <cstdlib>
#pragma warning(disable : 4996)
using namespace std;
const int L = 31;
const int N = 100;
const int M = 30;
struct toy {
	string name;
	double money;
	int down;
	int up;
};
struct rezult {
	string name;
	double money;
};
struct toyperech {
	double mon;
	int kol;
};
class masstr {
private:
	toy* px;
	int n;
	rezult* py;
	int m;
	toyperech* pu;
	int p;
public:
	masstr() :px(0), py(0), pu(0), n(0), m(0), p(0) { cout << "Конструктор без параметров\n"; }
	masstr(masstr& z);
	~masstr() {
		if (px != 0) delete[]px;
		if (py != 0)delete[]py;
		if (pu != 0)delete[]pu;
		cout << " Сработал деструктор\n"; _getch();
	}
	masstr& operator=(masstr& z);
	void inputMasToyFile();
	void outputMasToyFile();
	void outputMasToy();
	void outputMasToyRezult();
	void outputMasToyRezultFile();
	void FindMasToy();
	void addToy();
	void delToy();
	void SortMasToy1();
	void SortMasToy2();
	void SortMasToyRezult2();
	void perechtoy();
	void outputMasToyPerech();
	void outputMasToyPerechFile();
	void SortMasToyPerech1();
	void SortMasToyPerech2();
};
masstr::masstr(masstr& z) {
	int i;
	n = z.n;
	if (n == 0)px = 0;
	else {
		px = new toy[n]; if (px == 0) { cout << " нет памяти\n"; _getch(); exit(1); }
		for (i = 0; i < n; i++)
			px[i] = z.px[i];
	}
	m = z.m;
	if (n == 0)py = 0;
	else {
		py = new rezult[n]; if (py == 0) { cout << " нет памяти\n"; _getch(); exit(1); }
		for (i = 0; i < m; i++)
			py[i] = z.py[i];
	}
	p = z.p;
	if (n == 0)px = 0;
	else {
		pu = new toyperech[n]; if (px == 0) { cout << " нет памяти\n"; _getch(); exit(1); }
		for (i = 0; i < p; i++)
			pu[i] = z.pu[i];
	}
}
masstr& masstr::operator=(masstr& z) {
	int i;
	if (this == &z)return *this;
	n = z.n;
	if (n == 0)px = 0;
	else {
		px = new toy[n]; if (px == 0) { cout << " нет памяти\n"; _getch(); exit(1); }
		for (i = 0; i < n; i++)
			px[i] = z.px[i];
	}
	m = z.m;
	if (n == 0)py = 0;
	else {
		py = new rezult[n]; if (py == 0) { cout << " нет памяти\n"; _getch(); exit(1); }
		for (i = 0; i < m; i++)
			py[i] = z.py[i];
	}
	p = z.p;
	if (n == 0)px = 0;
	else {
		pu = new toyperech[n]; if (px == 0) { cout << " нет памяти\n"; _getch(); exit(1); }
		for (i = 0; i < p; i++)
			pu[i] = z.pu[i];
	}
	return *this;
}
void masstr::inputMasToyFile() {
	ifstream fin;
	char file[L];
	int i;
	toy t;
	cout << "Введите имя файла: ";
	cin >> file;
	fin.open(file);
	if (fin.fail()) {
		cout << file << " не открывается\n";
		_getch();
		return;
	}
	n = 0;
	while (1) {
		fin >> t.name >> t.money >> t.down >> t.up;
		if (fin.fail()) break;
		n++;
	}
	fin.close();
	if (px != 0)delete[]px;
	px = new toy[n];
	if (px == 0) {
		cout << "Нет памятиi\n";
		_getch();
		n = 0; return;
	}
	fin.open(file);
	if (fin.fail()) {
		cout << file << " Не открывается";
		_getch();
		delete[]px;
		px = 0; n = 0;
	}
	for (i = 0; i < n; i++)
		fin >> px[i].name >> px[i].money >> px[i].down >> px[i].up;
	fin.close();
	cout << "Файл введен\n";
	_getch();
}
void masstr::outputMasToyFile() {
	int i;
	ofstream fout;
	char file[L];
	cout << "Введите имя выходного файла: ";
	cin >> file;
	fout.open(file);
	if (fout.fail()) {
		cout << file << "Файл не удалось создать\n";
		_getch();
		return;
	}
	fout << " ----------------------------------------\n";
	fout << " |  №  | Название | Стоимость | Возраст |\n";
	fout << " |     |          |           | от | до |\n";
	fout << " ----------------------------------------\n";
	for (i = 0; i < n; i++)
		fout << " | " << setw(2) << i + 1 << " | " << setw(9) << px[i].name << " | " << setw(9) << px[i].money << " | " << setw(2) << px[i].down << " | " << setw(2) << px[i].up << " |\n";
	fout << " ----------------------------------------\n";	fout.close();
	cout << "Массив структур сохранен в файл\n";
	_getch();
}
void masstr::outputMasToy() {
	int i;
	cout << " ----------------------------------------\n";
	cout << " |  №  | Название | Стоимость | Возраст |\n";
	cout << " |     |          |           | от | до |\n";
	cout << " ----------------------------------------\n";
	for (i = 0; i < n; i++)
		cout << " | " << setw(2) << i + 1 << "  | " << setw(9) << px[i].name << "| " << setw(9) << px[i].money << " | " << setw(2) << px[i].down << " | " << setw(2) << px[i].up << " |\n";
	cout << " ----------------------------------------\n";
	_getch();
}
void masstr::outputMasToyRezult() {
	int i;
	cout << " ------------------------------\n";
	cout << " |  №  | Название | Стоимость |\n";
	cout << " |     |          |           |\n";
	cout << " ------------------------------\n";
	for (i = 0; i < m; i++)
		cout << " | " << setw(2) << i + 1 << "  | " << setw(9) << py[i].name << "| " << setw(9) << py[i].money << " |\n";
	cout << " ------------------------------\n";
	_getch();
}
void masstr::outputMasToyRezultFile() {
	int i;
	ofstream fout;
	char file[L];
	cout << "Введите имя выходного файла: ";
	cin >> file;
	fout.open(file);
	if (fout.fail()) {
		cout << file << "Файл не удалось создать\n";
		_getch();
		return;
	}
	fout << " ------------------------------\n";
	fout << " |  №  | Название | Стоимость |\n";
	fout << " |     |          |           |\n";
	fout << " ------------------------------\n";
	for (i = 0; i < m; i++)
		fout << " | " << setw(2) << i + 1 << " | " << setw(9) << py[i].name << " | " << setw(9) << py[i].money << " |\n";
	fout << " ------------------------------\n";
	fout.close();
	cout << "Массив структур сохранен в файл\n";
	_getch();
}
void masstr::FindMasToy() {
	int i,max;
	m = 0;
	max = -1;
	rezult* y;
	y = new rezult[n];
	if (y == NULL) {
		cout << "нет памяти\n";
		_getch();
		return;
	}
	int d; int u; int Z;
	rezult t;
	cout << " Введите возрастной диапазон\n";
	cout << " Нижняя граница:";
	cin >> d;
	cout << " Верхняя граница:";
	cin >> u;
	cout << " Введите максимальную допустимую разницу: ";
	cin >> Z;
	for (i = 0; i < n; i++) {
		if ((px[i].down >= d) && (px[i].up <= u))
			if (px[i].money > px[i + 1].money)
				max = px[i].money;
		if (px[i].money >= (max - Z)) {
			y[m].name = px[i].name;
			y[m].money = px[i].money;
			m++;
		}
	}
	if (px != NULL)delete[]py;
	py = new rezult[m];
	if (py == NULL) {
		cout << " net pamyati\n";
		_getch();
		m = 0; delete[]y;
		return;
	}
	for (int j = 0; j < m; j++)
		py[j] = y[j];
	delete[]y;
	cout << " Заданные игрушки найдены\n";
	_getch();
}
void masstr::addToy() {
	toy* p, t;
	p = new toy[n + 1];
	if (p == 0) {
		cout << " нет памяти\n"; _getch(); return;
	}
	cout << " Введите название игрушки: ";
	cin >> t.name;
	cout << " Введите стоимость игрушки: ";
	cin >> t.money;
	cout << " Введите возрастной диапазон: \n";
	cout << " Введите нижнюю границу: "; cin >> t.down;
	cout << " Введите верхнюю границу: "; cin >> t.up;
	for (int i = 0; i < n; i++)
		p[i] = px[i];
	p[n] = t;
	delete[]px;
	px = p;
	n++;
	cout << " Запись добавлена";
	_getch();
}
void masstr::delToy() {
	int i, j;
	toy* p;
	char ch;
	outputMasToy();
	cout << " Удаляемая сторока: "; cin >> j;
	if ((j < 0) || (j > n)) {
		cout << " Нет такой строки\n";
		_getch(); return;
	}
	j--;
	cout << j + 1 << " строка: "; cout << px[j].name << " " << px[j].money << " " << px[j].down << " " << px[j].up << endl;
	cout << " Удалить строку(n/y)?:";
	cin >> ch;
	if (ch == 'n')return;
	else if (!(ch == 'y')) {
		cout << " не понял\n";
		_getch(); return;
	}
	if (n == 1) {
		delete[]px;
		px = 0;
		n = 0;
		return;
	}
	else {
		p = new toy[n - 1];
		if (p == 0) {
			cout << "нет памяти\n"; _getch(); return;
		}
		for (i = 0; i < j; i++)
			p[i] = px[i];
		for (i = (j + 1); i < n; i++)
			p[i - 1] = px[i];
		delete[]px;
		px = p;
		n--;
		cout << " Запись удалена\n";
		_getch();
	}
}
void masstr::SortMasToy1() {
	int i, nn;
	bool fl;
	toy t;
	nn = n;
	do {
		fl = false; nn--;
		for (i = 0; i < nn; i++)
			if (px[i].money > px[i + 1].money) {
				t = px[i];
				px[i] = px[i + 1];
				px[i + 1] = t; fl = true;
			}

	} while (fl == true);
	cout << " Сортировка выполнена\n";
	_getch();
}

void masstr::SortMasToy2() {
	int i, nn;
	bool fl;
	toy t;
	nn = n;
	do {
		fl = false; nn--;
		for (i = 0; i < nn; i++)
			if (px[i].name > px[i + 1].name || (px[i].name == px[i + 1].name && px[i].money < px[i + 1].money)) {
				t = px[i];
				px[i] = px[i + 1];
				px[i + 1] = t; fl = true;
			}

	} while (fl == true);
	cout << " Сортировка выполнена\n";
	_getch();
}

void masstr::SortMasToyRezult2() {
	int i, mm;
	bool fl;
	rezult t;
	mm = m;
	do {
		fl = false; mm--;
		for (i = 0; i < mm; i++)
			if (py[i].name > py[i + 1].name) {
				t = py[i];
				py[i] = py[i + 1];
				py[i + 1] = t; fl = true;
			}
	} while (fl == true);
	cout << " Сортировка результата выполнена\n";
	_getch();
}
void masstr::perechtoy() {
	int i, j;
	bool fl;
	toyperech* r;
	r = new toyperech[n];
	if (r == 0) {
		cout << "нет памяти\n"; return;
	}
	p = 0;
	for (i = 0; i < n; i++) {
		fl = false;
		for (j = 0; j < p; j++)
			if (px[i].money == r[j].mon) {
				r[j].kol++;
				fl = true;
			}
		if (fl == false) {
			r[p].mon = px[i].money;
			r[p].kol = 1;
			p++;
		}
	}
	if (pu != NULL)delete[]pu;
	pu = new toyperech[p];
	if (pu == NULL) {
		cout << "нет памяти\n"; delete[]r; return;
	}
	for (j = 0; j < p; j++)
		pu[j] = r[j];
	delete[]r;
	cout << " Перечень сформирован\n";
	_getch();
}
void masstr::outputMasToyPerech() {
	int i;
	cout << " --------------------------------\n";
	cout << " |  №  | Стоимость | Количество |\n";
	cout << " |     |           |            |\n";
	cout << " --------------------------------\n";
	for (i = 0; i < p; i++)
		cout << " | " << setw(2) << i + 1 << "  | " << setw(9) << pu[i].mon << " | " << setw(10) << pu[i].kol << " |\n";
	cout << " --------------------------------\n";
	_getch();
}
void masstr::outputMasToyPerechFile() {
	int i;
	ofstream fout;
	char file[L];
	cout << "Введите имя выходного файла: ";
	cin >> file;
	fout.open(file);
	if (fout.fail()) {
		cout << file << "Файл не удалось создать\n";
		_getch();
		return;
	}
	fout << " --------------------------------\n";
	fout << " |  №  | Стоимость | Количество |\n";
	fout << " |     |           |            |\n";
	fout << " --------------------------------\n";
	for (i = 0; i < p; i++)
		fout << " | " << setw(2) << i + 1 << "  | " << setw(9) << pu[i].mon << " | " << setw(10) << pu[i].kol << " |\n";
	fout << " --------------------------------\n";
	fout.close();
	cout << "Массив структур сохранен в файл\n";
	_getch();
}
void masstr::SortMasToyPerech1() {
	int i, pp;
	bool fl;
	toyperech t;
	pp = p;
	do {
		fl = false; pp--;
		for (i = 0; i < pp; i++)
			if (pu[i].mon < pu[i + 1].mon) {
				t = pu[i];
				pu[i] = pu[i + 1];
				pu[i + 1] = t; fl = true;
			}
	} while (fl == true);
	cout << " Сортировка перечня выполнена\n";
	_getch();
}
void masstr::SortMasToyPerech2() {
	int i, pp;
	bool fl;
	toyperech t;
	pp = p;
	do {
		fl = false; pp--;
		for (i = 0; i < pp; i++)
			if (pu[i].kol > pu[i + 1].kol) {
				t = pu[i];
				pu[i] = pu[i + 1];
				pu[i + 1] = t; fl = true;
			}
	} while (fl == true);
	cout << " Сортировка перечня выполнена\n";
	_getch();
}
int prompt_menu_item() {
	int variant;
	cout << " Выберете тип сортировки:\n";
	cout << " 1. По стоимсти игрушек(по возрастанию)\n";
	cout << " 2. По названию игрушек(по алфавиту), а при совпадении по стоимости в порядке убывания\n";
	cout << " Ваш вариант: ";
	cin >> variant;
	return variant;
}
int prompt_menu_item2() {
	int variant3;
	cout << " Выберете тип сортировки:\n";
	cout << " 1. По стоимсти игрушек(по убыванию)\n";
	cout << " 2. По количеству игрушек(по возрастанию)\n";
	cout << " Ваш вариант: ";
	cin >> variant3;
	return variant3;
}
int main()
{
	setlocale(LC_ALL, "Russian");
	setlocale(LC_CTYPE, "rus");
	//SetConsoleCP(1251);
	//SetConsoleOutputCP(1251);
	masstr a;
	int  j, variant2, variant4;
	while (true)
	{
		system("cls");
		cout << " Рассчетно-графическая работа\n";
		cout << " \n  1. Ввод из файла исходных данных\n";
		cout << "  2. Вывод на экран исходных данных\n";
		cout << "  3. Добавление записей в исходный массив\n";
		cout << "  4. Удаление записей из исходного массива\n";
		cout << "  5. Вывод в файл исходного массива\n";
		cout << "  6. Поиск игрушек заданного диапазона\n";
		cout << "  7. Вывод на экран результат поиска\n";
		cout << "  8. Вывод в файл результат поиска\n";
		cout << "  9. Сформировать перечень\n";
		cout << "  10. Вывод на экран перечень\n";
		cout << "  11. Вывод в файл перечня\n";
		cout << "  12. Сортировки исходного массива\n";
		cout << "  13. Сортировка результата(по алфавиту)\n";
		cout << "  14. Сортировки перечня\n";
		cout << "  15. Проверка конструктора копирования\n";
		cout << "  16. Проверка конструктора присваивания\n";
		cout << "  17. Выход из программы\n "; cout << "\n";
		cout << " Введите ваш выбор(1-11): ";
		cin >> j;
		switch (j)
		{
		case 1:a.inputMasToyFile();
			_getch();
			break;
		case 2:a.outputMasToy(); _getch();
			break;
		case 3:a.addToy(); _getch();
			break;
		case 4:a.delToy(); _getch();
			break;
		case 5:a.outputMasToyFile(); _getch();
			break;
		case 6:a.FindMasToy(); _getch();
			break;
		case 7:a.outputMasToyRezult(); _getch();
			break;
		case 8:a.outputMasToyRezultFile(); _getch();
			break;
		case 9: a.perechtoy(); _getch();
			break;
		case 10:a.outputMasToyPerech(); _getch();
			break;
		case 11:a.outputMasToyPerechFile(); _getch();
			break;
		case 12:
		{
			system("cls");
			variant2 = prompt_menu_item();
			switch (variant2) {
			case 1:a.SortMasToy1(); _getch();
				break;
			case 2:a.SortMasToy2(); _getch();
				break;
			default: cout << "Нет такого варианта" << endl;
				_getch();
				break;
			}
			break;
		}
		case 13:
			a.SortMasToyRezult2(); _getch();
			break;
		case 14: {
			system("cls");
			variant4 = prompt_menu_item2();
			switch (variant4) {
			case 1:a.SortMasToyPerech1(); _getch();
				break;
			case 2:a.SortMasToyPerech2(); _getch();
				break;
			default: cout << "Нет такого варианта" << endl;
				_getch();
				break;
			}
			break;
		}
		case 15:
		{

			masstr b(a);
			a.outputMasToy();
			b.outputMasToy();
			//masstr c(a);
			a.outputMasToyRezult();
			b.outputMasToyRezult();
			//masstr d(a);
			a.outputMasToyPerech();
			b.outputMasToyPerech();
		}
		_getch(); break;
		case 16: {
			masstr b, c;
			c = b = a;
			a.outputMasToy();
			b.outputMasToy();
			c.outputMasToy();
			a.outputMasToyRezult();
			b.outputMasToyRezult();
			c.outputMasToyRezult();
			a.outputMasToyPerech();
			b.outputMasToyPerech();
			c.outputMasToyPerech();
		}
			   _getch(); break;
		case 17:
			cout << " Выход из программы..." << endl;
			_getch();
			return 0;
			break;
		default: cout << "Нет такого варианта" << endl;
			_getch();
			break;
		}
	}
}