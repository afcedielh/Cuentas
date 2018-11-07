using System.ComponentModel.DataAnnotations;

namespace Cuentas.Models.ViewModels
{
    public class VMUsuario
    {
        [Required(ErrorMessage = "El nombre de usuario es requerido.")]
        public string UserName { get; set; }

        [Required(ErrorMessage = "El Email es requerido.")]
        public string Email { get; set; }

        [Required(ErrorMessage = "la contraseña es requerido.")]
        public string Pass { get; set; }

        [Required(ErrorMessage = "la confirmación de la contraseña es requerida.")]
        [Compare("Pass", ErrorMessage = "Password and Confirmation Password must match.")]
        public string PassConfirm { get; set; }

        [Required(ErrorMessage = "El Documento del usuario es requerido.")]
        public int Documento { get; set; }

        [Required(ErrorMessage = "El Documento del usuario es requerido.")]
        public int TipoDocumento { get; set; }
    }
}