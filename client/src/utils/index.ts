export const isValidEmail = (email: string): boolean => {
  var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
};

export const ucWords = (text: string): string => text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();

export const terbilang = (a: number) => {
  let word = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
  let tenses = '';

  let utama;
  let front;
  let back;

  // 1 - 11
  if (a < 12) {
    tenses = word[a];
  }
  // 12 - 19
  else if (a < 20) {
    tenses = word[a - 10] + ' Belas';
  }
  // 20 - 99
  else if (a < 100) {
    utama = a / 10;
    front = parseInt(String(utama).substr(0, 1));
    back = a % 10;
    tenses = word[front] + ' Puluh ' + word[back];
  }
  // 100 - 199
  else if (a < 200) {
    tenses = 'Seratus ' + terbilang(a - 100);
  }
  // 200 - 999
  else if (a < 1000) {
    utama = a / 100;
    front = parseInt(String(utama).substr(0, 1));
    back = a % 100;
    tenses = word[front] + ' Ratus ' + terbilang(back);
  }
  // 1,000 - 1,999
  else if (a < 2000) {
    tenses = 'Seribu ' + terbilang(a - 1000);
  }
  // 2,000 - 9,999
  else if (a < 10000) {
    utama = a / 1000;
    front = parseInt(String(utama).substr(0, 1));
    back = a % 1000;
    tenses = word[front] + ' Ribu ' + terbilang(back);
  }
  // 10,000 - 99,999
  else if (a < 100000) {
    utama = a / 100;
    front = parseInt(String(utama).substr(0, 2));
    back = a % 1000;
    tenses = terbilang(front) + ' Ribu ' + terbilang(back);
  }
  // 100,000 - 999,999
  else if (a < 1000000) {
    utama = a / 1000;
    front = parseInt(String(utama).substr(0, 3));
    back = a % 1000;
    tenses = terbilang(front) + ' Ribu ' + terbilang(back);
  }
  // 1,000,000 - 	99,999,999
  else if (a < 100000000) {
    utama = a / 1000000;
    front = parseInt(String(utama).substr(0, 4));
    back = a % 1000000;
    tenses = terbilang(front) + ' Juta ' + terbilang(back);
  } else if (a < 1000000000) {
    utama = a / 1000000;
    front = parseInt(String(utama).substr(0, 4));
    back = a % 1000000;
    tenses = terbilang(front) + ' Juta ' + terbilang(back);
  } else if (a < 10000000000) {
    utama = a / 1000000000;
    front = parseInt(String(utama).substr(0, 1));
    back = a % 1000000000;
    tenses = terbilang(front) + ' Milyar ' + terbilang(back);
  } else if (a < 100000000000) {
    utama = a / 1000000000;
    front = parseInt(String(utama).substr(0, 2));
    back = a % 1000000000;
    tenses = terbilang(front) + ' Milyar ' + terbilang(back);
  } else if (a < 1000000000000) {
    utama = a / 1000000000;
    front = parseInt(String(utama).substr(0, 3));
    back = a % 1000000000;
    tenses = terbilang(front) + ' Milyar ' + terbilang(back);
  } else if (a < 10000000000000) {
    utama = a / 10000000000;
    front = parseInt(String(utama).substr(0, 1));
    back = a % 10000000000;
    tenses = terbilang(front) + ' Triliun ' + terbilang(back);
  } else if (a < 100000000000000) {
    utama = a / 1000000000000;
    front = parseInt(String(utama).substr(0, 2));
    back = a % 1000000000000;
    tenses = terbilang(front) + ' Triliun ' + terbilang(back);
  } else if (a < 1000000000000000) {
    utama = a / 1000000000000;
    front = parseInt(String(utama).substr(0, 3));
    back = a % 1000000000000;
    tenses = terbilang(front) + ' Triliun ' + terbilang(back);
  } else if (a < 10000000000000000) {
    utama = a / 1000000000000000;
    front = parseInt(String(utama).substr(0, 1));
    back = a % 1000000000000000;
    tenses = terbilang(front) + ' Kuadriliun ' + terbilang(back);
  }

  let splitString = tenses.split(' ');
  let full = [];
  for (let i = 0; i < splitString.length; i++) {
    if (splitString[i] !== '') {
      full.push(splitString[i]);
    }
  }
  return full.join(' ');
};

export const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

export const convertMonth = (monthNumber: number) => {
  return months[monthNumber - 1];
};

export const csvToJson = (csv: string, delimeter: string) => {
  const [firstLine, ...lines] = csv.split('\n');
  const keys = firstLine.replace(/\s/g, '').split(delimeter);
  const data = lines.filter(entry => {
    return entry.trim() !== '';
  });
  return data.map(line =>
    (values =>
      keys.reduce(
        (curr, next, index) => ({
          ...curr,
          [next]: values[index]
        }),
        {}
      ))(line.split(delimeter))
  );
};