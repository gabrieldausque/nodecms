﻿using BlackSheep.CMS.Models;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.CMS.Controllers
{
    [Route("/view/document")]
    public class CMSDocumentViewController : BaseCMSController
    {

        private readonly CRUDService<CMSDocument, CMSDocumentFilter> _model;


        public CMSDocumentViewController(CRUDService<CMSDocument, CMSDocumentFilter> model, 
            IConfigurationRoot configuration) : base(configuration)
        {
            _model = model;
        }

        [HttpGet]
        [Route("{documentId:int}")]
        public ViewResult Get(int documentId)
        {
            var document = _model.Get(documentId);
            ViewData["ApplicationTitle"] = Configuration.GetSection("BlackSheepCMS:Application:Title").Value;
            return View("DocumentView", document);
        }

        [HttpGet]
        [Route("{documentId:int}/edit")]
        public ViewResult Edit(int documentId)
        {
            var document = _model.Get(documentId);

            return View("DocumentEdit", document);
        }
    }
}
