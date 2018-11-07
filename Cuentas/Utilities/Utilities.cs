using System;
using System.Configuration;
using System.Security.Cryptography;
using System.Text;

namespace Cuentas.Utilities
{
    /// <summary>
    /// Clase utilitaria
    /// </summary>
    public class Utilities
    {
        /// <summary>
        /// metodo estatico que cifra cadena de caracteres
        /// </summary>
        /// <param name="texto">Texto que se va a encriptar</param>
        /// <returns></returns>
        public static string Encriptar(string texto)
        {
            try
            {
                string key = ConfigurationManager.AppSettings["KEY"];
                byte[] keyArray;
                byte[] Arreglo_a_Cifrar = Encoding.UTF8.GetBytes(texto);
                //Se utilizan las clases de encriptación MD5
                MD5CryptoServiceProvider hashmd5 = new MD5CryptoServiceProvider();
                keyArray = hashmd5.ComputeHash(Encoding.UTF8.GetBytes(key));
                hashmd5.Clear();
                //Algoritmo TripleDES
                TripleDESCryptoServiceProvider tdes = new TripleDESCryptoServiceProvider();
                tdes.Key = keyArray;
                tdes.Mode = CipherMode.ECB;
                tdes.Padding = PaddingMode.PKCS7;
                ICryptoTransform cTransform = tdes.CreateEncryptor();
                byte[] ArrayResultado = cTransform.TransformFinalBlock(Arreglo_a_Cifrar, 0, Arreglo_a_Cifrar.Length);
                tdes.Clear();
                //se regresa el resultado en forma de una cadena
                texto = Convert.ToBase64String(ArrayResultado, 0, ArrayResultado.Length);
            }
            catch (Exception ex)
            {
                throw;
            }
            return texto;
        }

        /// <summary>
        /// metodo estatico que decifra cadena de caracteres
        /// </summary>
        /// <param name="textoEncriptado"></param>
        /// <returns></returns>
        public static string Desencriptar(string textoEncriptado)
        {
            try
            {
                string key = ConfigurationManager.AppSettings["KEY"];
                byte[] keyArray;
                byte[] Array_a_Descifrar = Convert.FromBase64String(textoEncriptado);
                //algoritmo MD5
                MD5CryptoServiceProvider hashmd5 = new MD5CryptoServiceProvider();
                keyArray = hashmd5.ComputeHash(UTF8Encoding.UTF8.GetBytes(key));
                hashmd5.Clear();
                TripleDESCryptoServiceProvider tdes = new TripleDESCryptoServiceProvider();
                tdes.Key = keyArray;
                tdes.Mode = CipherMode.ECB;
                tdes.Padding = PaddingMode.PKCS7;
                ICryptoTransform cTransform = tdes.CreateDecryptor();
                byte[] resultArray = cTransform.TransformFinalBlock(Array_a_Descifrar, 0, Array_a_Descifrar.Length);
                tdes.Clear();
                textoEncriptado = UTF8Encoding.UTF8.GetString(resultArray);
            }
            catch (Exception)
            {
                throw;
            }
            return textoEncriptado;
        }
    }
}