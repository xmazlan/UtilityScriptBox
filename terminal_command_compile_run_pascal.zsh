echo '

# Compile and run Pascal file with error message for missing file
crp() {
    local nama_file="$1"

    if [[ -z "$nama_file" ]]; then
        echo "GUNAKAN: crp nama_file"
    else
        # Cek jika nama file berakhiran .pas, jika tidak, tambahkan ekstensi .pas
        if [[ "$nama_file" != *.pas ]]; then
            nama_file="$nama_file.pas"
        fi
        
        if [ ! -f "$nama_file" ]; then
            echo -e "File \e[31m'\''$nama_file'\''\e[0m tidak ditemukan."
        else
            fpc "$nama_file" && ./$(basename "$nama_file" .pas)
        fi
    fi
}' >> ~/.zshrc

