#!/usr/bin/env bash
kubectl apply -f Kubernetes/secrets.yml
kubectl apply -f Kubernetes/configmap.yml
kubectl apply -f Kubernetes/pv_storageclass.yml
kubectl apply -f Kubernetes/database_pv.yml
kubectl apply -f Kubernetes/database_pvc.yml
kubectl apply -f Kubernetes/database_service.yml
kubectl apply -f Kubernetes/database_statefulset.yml
kubectl apply -f Kubernetes/app_deployment.yml
kubectl apply -f Kubernetes/web_app_service.yml