# Tuliskan variabel dibawah ini
tahun = 2018
teks = "Saya adalah mahasiswa Polinema angkatan {}"

def penggabungan(tahun, teks):
    #Tuliskan kode program dibawah ini
    return teks.format(tahun)
    
print(penggabungan(tahun, teks))