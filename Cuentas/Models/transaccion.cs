//------------------------------------------------------------------------------
// <auto-generated>
//     Este código se generó a partir de una plantilla.
//
//     Los cambios manuales en este archivo pueden causar un comportamiento inesperado de la aplicación.
//     Los cambios manuales en este archivo se sobrescribirán si se regenera el código.
// </auto-generated>
//------------------------------------------------------------------------------

namespace Cuentas.Models
{
    using System;
    using System.Collections.Generic;
    
    public partial class transaccion
    {
        public int Id { get; set; }
        public int Usuario { get; set; }
        public int Monto { get; set; }
        public int Categoria { get; set; }
        public bool EsDeSistema { get; set; }
        public int Estado { get; set; }
        public int Meta { get; set; }
    
        public virtual Usuario Usuario1 { get; set; }
        public virtual EstadoTransaccion EstadoTransaccion { get; set; }
        public virtual Categorias Categorias { get; set; }
        public virtual Meta Meta1 { get; set; }
    }
}
